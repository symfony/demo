<?php

if (!isset($_SERVER['HTTP_HOST'])) {
    exit('This script cannot be run from the console. Run it from a browser.');
}

if (!in_array(@$_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {
    header('HTTP/1.0 403 Forbidden');
    exit('This script is only accessible from localhost.');
}

require_once dirname(__FILE__).'/../app/SymfonyRequirements.php';

$symfonyRequirements = new SymfonyRequirements();

$majorProblems = $symfonyRequirements->getFailedRequirements();
$minorProblems = $symfonyRequirements->getFailedRecommendations();

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Symfony Demo Application</title>
        <link rel="stylesheet" href="css/app.css">
        <link rel="icon" type="image/x-icon" href="favicon.ico" />
    </head>

    <body id="requirements_checker">
        <header>
            <div class="navbar navbar-default navbar-static-top" role="navigation">
                <div class="container">
                    <div class="navbar-header">
                        <h1 class="navbar-brand">
                            Symfony Demo Application <span>/</span> Technical Requirements Checker
                        </span>
                    </div>
                </div>
            </div>
        </header>

        <div class="container body-container">
            <div class="row">
                <div id="main" class="col-sm-9">
                    <div class="row">
                        <?php if (count($majorProblems)): ?>
                            <div class="panel panel-danger">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <i class="fa fa-exclamation-circle"></i>
                                        Fix these problems before continuing
                                    </h3>
                                </div>
                                <div class="panel-body">
                                    <p>These <strong>mandatory requirements</strong> must be fixed before running Symfony applications:</p>

                                    <ol>
                                        <?php foreach ($majorProblems as $problem): ?>
                                            <li><?php echo $problem->getHelpHtml() ?></li>
                                        <?php endforeach; ?>
                                    </ol>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if (count($minorProblems)): ?>
                            <div class="panel panel-warning">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <i class="fa fa-exclamation-triangle"></i>
                                        Fix these problems to improve your experience
                                    </h3>
                                </div>
                                <div class="panel-body">
                                    <p>These <strong>optional requirements</strong> should be fixed to improve your experience running Symfony applications:</p>

                                    <ol>
                                        <?php foreach ($minorProblems as $problem): ?>
                                            <li><?php echo $problem->getHelpHtml() ?></li>
                                        <?php endforeach; ?>
                                    </ol>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($symfonyRequirements->hasPhpIniConfigIssue()): ?>
                            <p id="phpini">*
                                <?php if ($symfonyRequirements->getPhpIniConfigPath()): ?>
                                    Changes to the <strong>php.ini</strong> file must be done in the "<strong><?php echo $symfonyRequirements->getPhpIniConfigPath() ?></strong>" file.
                                <?php else: ?>
                                    To change settings, create a "<strong>php.ini</strong>".
                                <?php endif; ?>
                            </p>
                        <?php endif; ?>

                        <?php if (!count($majorProblems) && !count($minorProblems)): ?>
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <i class="fa fa-check"></i>
                                        All checks passed successfully
                                    </h3>
                                </div>
                                <div class="panel-body">
                                    <p>Your configuration looks good to run the Symfony Demo application.</p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div id="sidebar" class="col-sm-3">
                    <div class="section about">
                        <div class="well well-lg">
                            <p>
                                This script checks whether your system meets the
                                technical requirements for running Symfony
                                applications.
                            </p>
                            <p>
                                For more information, check out the
                                <a href="http://symfony.com/doc/current/reference/requirements.html">requirements list</a>
                                at the Symfony documentation.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <footer>
            <div class="container">
                <div class="row">
                    <div id="footer-copyright" class="col-md-6">
                        <p>&copy; 2015 - The Symfony Project</p>
                        <p>MIT License</p>
                    </div>
                    <div id="footer-resources" class="col-md-6">
                        <p>
                            <a href="https://twitter.com/symfony"><i class="fa fa-twitter"></i></a>
                            <a href="https://www.facebook.com/SensioLabs"><i class="fa fa-facebook"></i></a>
                            <a href="http://symfony.com/blog"><i class="fa fa-rss"></i></a>
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
