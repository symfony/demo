## General Documentation for config package

This documentation provides a comprehensive overview of the `config` package, outlining its purpose, functionality, and usage guidelines. The package focuses on managing application configurations, including bundle activation, pre-loading container data, and potentially other configuration aspects specific to the project. 


## Table of Contents
- [bundles.md](bundles.md) - This file defines a configuration array for Symfony bundles used in a web application. Each key represents a bundle class, and its value is an associative array specifying environments where the bundle should be enabled (e.g., 'dev', 'test', 'all'). 
- [preload.md](preload.md) - This PHP script `preload.php` is designed to load pre-compiled container data for a Symfony application in production mode. It checks if a pre-loaded container file exists and includes it if found, optimizing the application startup process.  



