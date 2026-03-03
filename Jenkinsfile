pipeline {
    agent any

    environment {
        // Unique identifiers for this specific build
        NET_NAME   = "net-${env.BUILD_ID}"
        DB_NAME    = "db-${env.BUILD_ID}"
        APP_NAME   = "app-${env.BUILD_ID}"
        
        // Database Credentials
        DB_USER     = "symfony"
        DB_PASS     = "secret"
        DB_DATABASE = "app_db"
        
        // Dynamic Port for the Web UI
        TEST_PORT  = "${9000 + (env.BUILD_NUMBER.toInteger() % 1000)}"
    }

    stages {
        stage('Setup Network & DB') {
            steps {
                // Create a dedicated network so containers can "see" each other
                sh "docker network create ${NET_NAME}"
                
                // Spin up MySQL and wait for it to be ready
                sh """
                docker run -d --name ${DB_NAME} --network ${NET_NAME} \
                    -e MYSQL_ROOT_PASSWORD=root \
                    -e MYSQL_DATABASE=${DB_DATABASE} \
                    -e MYSQL_USER=${DB_USER} \
                    -e MYSQL_PASSWORD=${DB_PASS} \
                    mysql:8.0
                """
                echo "Waiting for MySQL to initialize..."
                sleep 15 // Give MySQL a moment to start up
            }
        }

        stage('Build & Migrations') {
            steps {
                script {
                    // Build your Symfony Image
                    def symfonyImage = docker.build("${APP_NAME}:latest")
                    
                    // Run Migrations inside the network before starting the web server
                    sh """
                    docker run --rm --network ${NET_NAME} \
                        -e DATABASE_URL="mysql://${DB_USER}:${DB_PASS}@${DB_NAME}:3306/${DB_DATABASE}?serverVersion=8.0" \
                        ${APP_NAME}:latest php bin/console doctrine:migrations:migrate --no-interaction
                    """
                }
            }
        }

        stage('Deploy Ephemeral App') {
            steps {
                // Run the web server
                sh """
                docker run -d --name ${APP_NAME} --network ${NET_NAME} -p ${TEST_PORT}:8000 \
                    -e DATABASE_URL="mysql://${DB_USER}:${DB_PASS}@${DB_NAME}:3306/${DB_DATABASE}?serverVersion=8.0" \
                    ${APP_NAME}:latest php -S 0.0.0.0:8000 -t public
                """
                
                echo "------------------------------------------------------------"
                echo "SUCCESS: Symfony is live at http://your-server-ip:${TEST_PORT}"
                echo "Database Host inside network: ${DB_NAME}"
                echo "------------------------------------------------------------"
            }
        }

        stage('Manual Review') {
            steps {
                // This will pause the pipeline and wait for a user to click "Proceed" or "Abort"
                input message: "Review the application at http://your-server-ip:${TEST_PORT}. Click 'Proceed' to kill the environment.", ok: "Proceed"
            }
        }
    }

    post {
        always {
            echo "Cleaning up ephemeral environment..."
            // Remove containers and the network regardless of success/failure/manual stop
            sh "docker stop ${APP_NAME} ${DB_NAME} || true"
            sh "docker rm ${APP_NAME} ${DB_NAME} || true"
            sh "docker network rm ${NET_NAME} || true"
            sh "docker rmi ${APP_NAME}:latest || true"
        }
    }
}