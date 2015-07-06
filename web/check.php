<?php

if (!isset($_SERVER['HTTP_HOST'])) {
    exit('This script cannot be run from the CLI. Run it from a browser.');
}

if (!in_array(@$_SERVER['REMOTE_ADDR'], array(
    '127.0.0.1',
    '::1',
))) {
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
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="robots" content="noindex,nofollow" />
        <title>Symfony Configuration</title>
        <link rel="stylesheet" href="bundles/framework/css/structure.css" media="all" />
        <link rel="stylesheet" href="bundles/framework/css/body.css" media="all" />
        <link rel="stylesheet" href="bundles/sensiodistribution/webconfigurator/css/install.css" media="all" />
    </head>
    <body>
        <div id="content">
            <div class="header clear-fix">
                <div class="header-logo">
                    <img src="bundles/framework/images/logo_symfony.png" alt="Symfony" />
                </div>

                <div class="search">
                  <form method="get" action="http://symfony.com/search">
                    <div class="form-row">

                      <label for="search-id">
                          <img src="bundles/framework/images/grey_magnifier.png" alt="Search on Symfony website" />
                      </label>

                      <input name="q" id="search-id" type="search" placeholder="Search on Symfony website" />

                      <button type="submit" class="sf-button">
                          <span class="border-l">
                            <span class="border-r">
                                <span class="btn-bg">OK</span>
                            </span>
                        </span>
                      </button>
                    </div>
                   </form>
                </div>
            </div>

            <div class="sf-reset">
                <div class="block">
                    <div class="symfony-block-content">
                        <h1 class="title">Welcome!</h1>
                        <p>Welcome to the <strong>Symfony Demo Application</strong>.</p>
                        <p>
                            This script will guide you through the required and optional environment configuration parameters for this project.
                        </p>

                        <?php if (count($majorProblems)): ?>
                            <h2 class="ko">Major problems</h2>
                            <p>Major problems have been detected and <strong>must</strong> be fixed before continuing:</p>
                            <ol>
                                <?php foreach ($majorProblems as $problem): ?>
                                    <li><?php echo $problem->getHelpHtml() ?></li>
                                <?php endforeach; ?>
                            </ol>
                        <?php endif; ?>

                        <?php if (count($minorProblems)): ?>
                            <h2>Recommendations</h2>
                            <p>
                                <?php if (count($majorProblems)): ?>Additionally, to<?php else: ?>To<?php endif; ?> enhance your Symfony experience,
                                it’s recommended that you fix the following:
                            </p>
                            <ol>
                                <?php foreach ($minorProblems as $problem): ?>
                                    <li><?php echo $problem->getHelpHtml() ?></li>
                                <?php endforeach; ?>
                            </ol>
                        <?php endif; ?>

                        <?php if ($symfonyRequirements->hasPhpIniConfigIssue()): ?>
                            <p id="phpini">*
                                <?php if ($symfonyRequirements->getPhpIniConfigPath()): ?>
                                    Changes to the <strong>php.ini</strong> file must be done in "<strong><?php echo $symfonyRequirements->getPhpIniConfigPath() ?></strong>".
                                <?php else: ?>
                                    To change settings, create a "<strong>php.ini</strong>".
                                <?php endif; ?>
                            </p>
                        <?php endif; ?>

                        <?php if (!count($majorProblems) && !count($minorProblems)): ?>
                            <p class="ok">Your configuration looks good to run Symfony Demo Application.</p>
                        <?php endif; ?>

                        <ul class="symfony-install-continue">
                            <?php if (!count($majorProblems)): ?>
                                <li><a href="app_dev.php/">Go to the Welcome page</a></li>
                            <?php endif; ?>
                            <?php if (count($majorProblems) || count($minorProblems)): ?>
                                <li><a href="config.php">Re-check configuration</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="version">Symfony Demo Application</div>
        </div>
    </body>
</html>
