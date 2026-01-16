<?php

// This file is auto-generated and is for apps only. Bundles SHOULD NOT rely on its content.

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Symfony\Component\Config\Loader\ParamConfigurator as Param;

/**
 * This class provides array-shapes for configuring the services and bundles of an application.
 *
 * Services declared with the config() method below are autowired and autoconfigured by default.
 *
 * This is for apps only. Bundles SHOULD NOT use it.
 *
 * Example:
 *
 *     ```php
 *     // config/services.php
 *     namespace Symfony\Component\DependencyInjection\Loader\Configurator;
 *
 *     return App::config([
 *         'services' => [
 *             'App\\' => [
 *                 'resource' => '../src/',
 *             ],
 *         ],
 *     ]);
 *     ```
 *
 * @psalm-type ImportsConfig = list<string|array{
 *     resource: string,
 *     type?: string|null,
 *     ignore_errors?: bool,
 * }>
 * @psalm-type ParametersConfig = array<string, scalar|\UnitEnum|array<scalar|\UnitEnum|array<mixed>|null>|null>
 * @psalm-type ArgumentsType = list<mixed>|array<string, mixed>
 * @psalm-type CallType = array<string, ArgumentsType>|array{0:string, 1?:ArgumentsType, 2?:bool}|array{method:string, arguments?:ArgumentsType, returns_clone?:bool}
 * @psalm-type TagsType = list<string|array<string, array<string, mixed>>> // arrays inside the list must have only one element, with the tag name as the key
 * @psalm-type CallbackType = string|array{0:string|ReferenceConfigurator,1:string}|\Closure|ReferenceConfigurator|ExpressionConfigurator
 * @psalm-type DeprecationType = array{package: string, version: string, message?: string}
 * @psalm-type DefaultsType = array{
 *     public?: bool,
 *     tags?: TagsType,
 *     resource_tags?: TagsType,
 *     autowire?: bool,
 *     autoconfigure?: bool,
 *     bind?: array<string, mixed>,
 * }
 * @psalm-type InstanceofType = array{
 *     shared?: bool,
 *     lazy?: bool|string,
 *     public?: bool,
 *     properties?: array<string, mixed>,
 *     configurator?: CallbackType,
 *     calls?: list<CallType>,
 *     tags?: TagsType,
 *     resource_tags?: TagsType,
 *     autowire?: bool,
 *     bind?: array<string, mixed>,
 *     constructor?: string,
 * }
 * @psalm-type DefinitionType = array{
 *     class?: string,
 *     file?: string,
 *     parent?: string,
 *     shared?: bool,
 *     synthetic?: bool,
 *     lazy?: bool|string,
 *     public?: bool,
 *     abstract?: bool,
 *     deprecated?: DeprecationType,
 *     factory?: CallbackType,
 *     configurator?: CallbackType,
 *     arguments?: ArgumentsType,
 *     properties?: array<string, mixed>,
 *     calls?: list<CallType>,
 *     tags?: TagsType,
 *     resource_tags?: TagsType,
 *     decorates?: string,
 *     decoration_inner_name?: string,
 *     decoration_priority?: int,
 *     decoration_on_invalid?: 'exception'|'ignore'|null,
 *     autowire?: bool,
 *     autoconfigure?: bool,
 *     bind?: array<string, mixed>,
 *     constructor?: string,
 *     from_callable?: CallbackType,
 * }
 * @psalm-type AliasType = string|array{
 *     alias: string,
 *     public?: bool,
 *     deprecated?: DeprecationType,
 * }
 * @psalm-type PrototypeType = array{
 *     resource: string,
 *     namespace?: string,
 *     exclude?: string|list<string>,
 *     parent?: string,
 *     shared?: bool,
 *     lazy?: bool|string,
 *     public?: bool,
 *     abstract?: bool,
 *     deprecated?: DeprecationType,
 *     factory?: CallbackType,
 *     arguments?: ArgumentsType,
 *     properties?: array<string, mixed>,
 *     configurator?: CallbackType,
 *     calls?: list<CallType>,
 *     tags?: TagsType,
 *     resource_tags?: TagsType,
 *     autowire?: bool,
 *     autoconfigure?: bool,
 *     bind?: array<string, mixed>,
 *     constructor?: string,
 * }
 * @psalm-type StackType = array{
 *     stack: list<DefinitionType|AliasType|PrototypeType|array<class-string, ArgumentsType|null>>,
 *     public?: bool,
 *     deprecated?: DeprecationType,
 * }
 * @psalm-type ServicesConfig = array{
 *     _defaults?: DefaultsType,
 *     _instanceof?: InstanceofType,
 *     ...<string, DefinitionType|AliasType|PrototypeType|StackType|ArgumentsType|null>
 * }
 * @psalm-type ExtensionType = array<string, mixed>
 * @psalm-type FrameworkConfig = array{
 *     secret?: scalar|null|Param,
 *     http_method_override?: bool|Param, // Set true to enable support for the '_method' request parameter to determine the intended HTTP method on POST requests. // Default: false
 *     allowed_http_method_override?: list<string|Param>|null,
 *     trust_x_sendfile_type_header?: scalar|null|Param, // Set true to enable support for xsendfile in binary file responses. // Default: "%env(bool:default::SYMFONY_TRUST_X_SENDFILE_TYPE_HEADER)%"
 *     ide?: scalar|null|Param, // Default: "%env(default::SYMFONY_IDE)%"
 *     test?: bool|Param,
 *     default_locale?: scalar|null|Param, // Default: "en"
 *     set_locale_from_accept_language?: bool|Param, // Whether to use the Accept-Language HTTP header to set the Request locale (only when the "_locale" request attribute is not passed). // Default: false
 *     set_content_language_from_locale?: bool|Param, // Whether to set the Content-Language HTTP header on the Response using the Request locale. // Default: false
 *     enabled_locales?: list<scalar|null|Param>,
 *     trusted_hosts?: list<scalar|null|Param>,
 *     trusted_proxies?: mixed, // Default: ["%env(default::SYMFONY_TRUSTED_PROXIES)%"]
 *     trusted_headers?: list<scalar|null|Param>,
 *     error_controller?: scalar|null|Param, // Default: "error_controller"
 *     handle_all_throwables?: bool|Param, // HttpKernel will handle all kinds of \Throwable. // Default: true
 *     csrf_protection?: bool|array{
 *         enabled?: scalar|null|Param, // Default: null
 *         stateless_token_ids?: list<scalar|null|Param>,
 *         check_header?: scalar|null|Param, // Whether to check the CSRF token in a header in addition to a cookie when using stateless protection. // Default: false
 *         cookie_name?: scalar|null|Param, // The name of the cookie to use when using stateless protection. // Default: "csrf-token"
 *     },
 *     form?: bool|array{ // Form configuration
 *         enabled?: bool|Param, // Default: true
 *         csrf_protection?: array{
 *             enabled?: scalar|null|Param, // Default: null
 *             token_id?: scalar|null|Param, // Default: null
 *             field_name?: scalar|null|Param, // Default: "_token"
 *             field_attr?: array<string, scalar|null|Param>,
 *         },
 *     },
 *     http_cache?: bool|array{ // HTTP cache configuration
 *         enabled?: bool|Param, // Default: false
 *         debug?: bool|Param, // Default: "%kernel.debug%"
 *         trace_level?: "none"|"short"|"full"|Param,
 *         trace_header?: scalar|null|Param,
 *         default_ttl?: int|Param,
 *         private_headers?: list<scalar|null|Param>,
 *         skip_response_headers?: list<scalar|null|Param>,
 *         allow_reload?: bool|Param,
 *         allow_revalidate?: bool|Param,
 *         stale_while_revalidate?: int|Param,
 *         stale_if_error?: int|Param,
 *         terminate_on_cache_hit?: bool|Param,
 *     },
 *     esi?: bool|array{ // ESI configuration
 *         enabled?: bool|Param, // Default: false
 *     },
 *     ssi?: bool|array{ // SSI configuration
 *         enabled?: bool|Param, // Default: false
 *     },
 *     fragments?: bool|array{ // Fragments configuration
 *         enabled?: bool|Param, // Default: false
 *         hinclude_default_template?: scalar|null|Param, // Default: null
 *         path?: scalar|null|Param, // Default: "/_fragment"
 *     },
 *     profiler?: bool|array{ // Profiler configuration
 *         enabled?: bool|Param, // Default: false
 *         collect?: bool|Param, // Default: true
 *         collect_parameter?: scalar|null|Param, // The name of the parameter to use to enable or disable collection on a per request basis. // Default: null
 *         only_exceptions?: bool|Param, // Default: false
 *         only_main_requests?: bool|Param, // Default: false
 *         dsn?: scalar|null|Param, // Default: "file:%kernel.cache_dir%/profiler"
 *         collect_serializer_data?: true|Param, // Default: true
 *     },
 *     workflows?: bool|array{
 *         enabled?: bool|Param, // Default: false
 *         workflows?: array<string, array{ // Default: []
 *             audit_trail?: bool|array{
 *                 enabled?: bool|Param, // Default: false
 *             },
 *             type?: "workflow"|"state_machine"|Param, // Default: "state_machine"
 *             marking_store?: array{
 *                 type?: "method"|Param,
 *                 property?: scalar|null|Param,
 *                 service?: scalar|null|Param,
 *             },
 *             supports?: list<scalar|null|Param>,
 *             definition_validators?: list<scalar|null|Param>,
 *             support_strategy?: scalar|null|Param,
 *             initial_marking?: list<scalar|null|Param>,
 *             events_to_dispatch?: list<string|Param>|null,
 *             places?: list<array{ // Default: []
 *                 name: scalar|null|Param,
 *                 metadata?: list<mixed>,
 *             }>,
 *             transitions: list<array{ // Default: []
 *                 name: string|Param,
 *                 guard?: string|Param, // An expression to block the transition.
 *                 from?: list<array{ // Default: []
 *                     place: string|Param,
 *                     weight?: int|Param, // Default: 1
 *                 }>,
 *                 to?: list<array{ // Default: []
 *                     place: string|Param,
 *                     weight?: int|Param, // Default: 1
 *                 }>,
 *                 weight?: int|Param, // Default: 1
 *                 metadata?: list<mixed>,
 *             }>,
 *             metadata?: list<mixed>,
 *         }>,
 *     },
 *     router?: bool|array{ // Router configuration
 *         enabled?: bool|Param, // Default: false
 *         resource: scalar|null|Param,
 *         type?: scalar|null|Param,
 *         default_uri?: scalar|null|Param, // The default URI used to generate URLs in a non-HTTP context. // Default: null
 *         http_port?: scalar|null|Param, // Default: 80
 *         https_port?: scalar|null|Param, // Default: 443
 *         strict_requirements?: scalar|null|Param, // set to true to throw an exception when a parameter does not match the requirements set to false to disable exceptions when a parameter does not match the requirements (and return null instead) set to null to disable parameter checks against requirements 'true' is the preferred configuration in development mode, while 'false' or 'null' might be preferred in production // Default: true
 *         utf8?: bool|Param, // Default: true
 *     },
 *     session?: bool|array{ // Session configuration
 *         enabled?: bool|Param, // Default: false
 *         storage_factory_id?: scalar|null|Param, // Default: "session.storage.factory.native"
 *         handler_id?: scalar|null|Param, // Defaults to using the native session handler, or to the native *file* session handler if "save_path" is not null.
 *         name?: scalar|null|Param,
 *         cookie_lifetime?: scalar|null|Param,
 *         cookie_path?: scalar|null|Param,
 *         cookie_domain?: scalar|null|Param,
 *         cookie_secure?: true|false|"auto"|Param, // Default: "auto"
 *         cookie_httponly?: bool|Param, // Default: true
 *         cookie_samesite?: null|"lax"|"strict"|"none"|Param, // Default: "lax"
 *         use_cookies?: bool|Param,
 *         gc_divisor?: scalar|null|Param,
 *         gc_probability?: scalar|null|Param,
 *         gc_maxlifetime?: scalar|null|Param,
 *         save_path?: scalar|null|Param, // Defaults to "%kernel.cache_dir%/sessions" if the "handler_id" option is not null.
 *         metadata_update_threshold?: int|Param, // Seconds to wait between 2 session metadata updates. // Default: 0
 *     },
 *     request?: bool|array{ // Request configuration
 *         enabled?: bool|Param, // Default: false
 *         formats?: array<string, string|list<scalar|null|Param>>,
 *     },
 *     assets?: bool|array{ // Assets configuration
 *         enabled?: bool|Param, // Default: true
 *         strict_mode?: bool|Param, // Throw an exception if an entry is missing from the manifest.json. // Default: false
 *         version_strategy?: scalar|null|Param, // Default: null
 *         version?: scalar|null|Param, // Default: null
 *         version_format?: scalar|null|Param, // Default: "%%s?%%s"
 *         json_manifest_path?: scalar|null|Param, // Default: null
 *         base_path?: scalar|null|Param, // Default: ""
 *         base_urls?: list<scalar|null|Param>,
 *         packages?: array<string, array{ // Default: []
 *             strict_mode?: bool|Param, // Throw an exception if an entry is missing from the manifest.json. // Default: false
 *             version_strategy?: scalar|null|Param, // Default: null
 *             version?: scalar|null|Param,
 *             version_format?: scalar|null|Param, // Default: null
 *             json_manifest_path?: scalar|null|Param, // Default: null
 *             base_path?: scalar|null|Param, // Default: ""
 *             base_urls?: list<scalar|null|Param>,
 *         }>,
 *     },
 *     asset_mapper?: bool|array{ // Asset Mapper configuration
 *         enabled?: bool|Param, // Default: true
 *         paths?: array<string, scalar|null|Param>,
 *         excluded_patterns?: list<scalar|null|Param>,
 *         exclude_dotfiles?: bool|Param, // If true, any files starting with "." will be excluded from the asset mapper. // Default: true
 *         server?: bool|Param, // If true, a "dev server" will return the assets from the public directory (true in "debug" mode only by default). // Default: true
 *         public_prefix?: scalar|null|Param, // The public path where the assets will be written to (and served from when "server" is true). // Default: "/assets/"
 *         missing_import_mode?: "strict"|"warn"|"ignore"|Param, // Behavior if an asset cannot be found when imported from JavaScript or CSS files - e.g. "import './non-existent.js'". "strict" means an exception is thrown, "warn" means a warning is logged, "ignore" means the import is left as-is. // Default: "warn"
 *         extensions?: array<string, scalar|null|Param>,
 *         importmap_path?: scalar|null|Param, // The path of the importmap.php file. // Default: "%kernel.project_dir%/importmap.php"
 *         importmap_polyfill?: scalar|null|Param, // The importmap name that will be used to load the polyfill. Set to false to disable. // Default: "es-module-shims"
 *         importmap_script_attributes?: array<string, scalar|null|Param>,
 *         vendor_dir?: scalar|null|Param, // The directory to store JavaScript vendors. // Default: "%kernel.project_dir%/assets/vendor"
 *         precompress?: bool|array{ // Precompress assets with Brotli, Zstandard and gzip.
 *             enabled?: bool|Param, // Default: false
 *             formats?: list<scalar|null|Param>,
 *             extensions?: list<scalar|null|Param>,
 *         },
 *     },
 *     translator?: bool|array{ // Translator configuration
 *         enabled?: bool|Param, // Default: true
 *         fallbacks?: list<scalar|null|Param>,
 *         logging?: bool|Param, // Default: false
 *         formatter?: scalar|null|Param, // Default: "translator.formatter.default"
 *         cache_dir?: scalar|null|Param, // Default: "%kernel.cache_dir%/translations"
 *         default_path?: scalar|null|Param, // The default path used to load translations. // Default: "%kernel.project_dir%/translations"
 *         paths?: list<scalar|null|Param>,
 *         pseudo_localization?: bool|array{
 *             enabled?: bool|Param, // Default: false
 *             accents?: bool|Param, // Default: true
 *             expansion_factor?: float|Param, // Default: 1.0
 *             brackets?: bool|Param, // Default: true
 *             parse_html?: bool|Param, // Default: false
 *             localizable_html_attributes?: list<scalar|null|Param>,
 *         },
 *         providers?: array<string, array{ // Default: []
 *             dsn?: scalar|null|Param,
 *             domains?: list<scalar|null|Param>,
 *             locales?: list<scalar|null|Param>,
 *         }>,
 *         globals?: array<string, string|array{ // Default: []
 *             value?: mixed,
 *             message?: string|Param,
 *             parameters?: array<string, scalar|null|Param>,
 *             domain?: string|Param,
 *         }>,
 *     },
 *     validation?: bool|array{ // Validation configuration
 *         enabled?: bool|Param, // Default: true
 *         enable_attributes?: bool|Param, // Default: true
 *         static_method?: list<scalar|null|Param>,
 *         translation_domain?: scalar|null|Param, // Default: "validators"
 *         email_validation_mode?: "html5"|"html5-allow-no-tld"|"strict"|Param, // Default: "html5"
 *         mapping?: array{
 *             paths?: list<scalar|null|Param>,
 *         },
 *         not_compromised_password?: bool|array{
 *             enabled?: bool|Param, // When disabled, compromised passwords will be accepted as valid. // Default: true
 *             endpoint?: scalar|null|Param, // API endpoint for the NotCompromisedPassword Validator. // Default: null
 *         },
 *         disable_translation?: bool|Param, // Default: false
 *         auto_mapping?: array<string, array{ // Default: []
 *             services?: list<scalar|null|Param>,
 *         }>,
 *     },
 *     serializer?: bool|array{ // Serializer configuration
 *         enabled?: bool|Param, // Default: false
 *         enable_attributes?: bool|Param, // Default: true
 *         name_converter?: scalar|null|Param,
 *         circular_reference_handler?: scalar|null|Param,
 *         max_depth_handler?: scalar|null|Param,
 *         mapping?: array{
 *             paths?: list<scalar|null|Param>,
 *         },
 *         default_context?: list<mixed>,
 *         named_serializers?: array<string, array{ // Default: []
 *             name_converter?: scalar|null|Param,
 *             default_context?: list<mixed>,
 *             include_built_in_normalizers?: bool|Param, // Whether to include the built-in normalizers // Default: true
 *             include_built_in_encoders?: bool|Param, // Whether to include the built-in encoders // Default: true
 *         }>,
 *     },
 *     property_access?: bool|array{ // Property access configuration
 *         enabled?: bool|Param, // Default: true
 *         magic_call?: bool|Param, // Default: false
 *         magic_get?: bool|Param, // Default: true
 *         magic_set?: bool|Param, // Default: true
 *         throw_exception_on_invalid_index?: bool|Param, // Default: false
 *         throw_exception_on_invalid_property_path?: bool|Param, // Default: true
 *     },
 *     type_info?: bool|array{ // Type info configuration
 *         enabled?: bool|Param, // Default: true
 *         aliases?: array<string, scalar|null|Param>,
 *     },
 *     property_info?: bool|array{ // Property info configuration
 *         enabled?: bool|Param, // Default: true
 *         with_constructor_extractor?: bool|Param, // Registers the constructor extractor. // Default: true
 *     },
 *     cache?: array{ // Cache configuration
 *         prefix_seed?: scalar|null|Param, // Used to namespace cache keys when using several apps with the same shared backend. // Default: "_%kernel.project_dir%.%kernel.container_class%"
 *         app?: scalar|null|Param, // App related cache pools configuration. // Default: "cache.adapter.filesystem"
 *         system?: scalar|null|Param, // System related cache pools configuration. // Default: "cache.adapter.system"
 *         directory?: scalar|null|Param, // Default: "%kernel.share_dir%/pools/app"
 *         default_psr6_provider?: scalar|null|Param,
 *         default_redis_provider?: scalar|null|Param, // Default: "redis://localhost"
 *         default_valkey_provider?: scalar|null|Param, // Default: "valkey://localhost"
 *         default_memcached_provider?: scalar|null|Param, // Default: "memcached://localhost"
 *         default_doctrine_dbal_provider?: scalar|null|Param, // Default: "database_connection"
 *         default_pdo_provider?: scalar|null|Param, // Default: null
 *         pools?: array<string, array{ // Default: []
 *             adapters?: list<scalar|null|Param>,
 *             tags?: scalar|null|Param, // Default: null
 *             public?: bool|Param, // Default: false
 *             default_lifetime?: scalar|null|Param, // Default lifetime of the pool.
 *             provider?: scalar|null|Param, // Overwrite the setting from the default provider for this adapter.
 *             early_expiration_message_bus?: scalar|null|Param,
 *             clearer?: scalar|null|Param,
 *         }>,
 *     },
 *     php_errors?: array{ // PHP errors handling configuration
 *         log?: mixed, // Use the application logger instead of the PHP logger for logging PHP errors. // Default: true
 *         throw?: bool|Param, // Throw PHP errors as \ErrorException instances. // Default: true
 *     },
 *     exceptions?: array<string, array{ // Default: []
 *         log_level?: scalar|null|Param, // The level of log message. Null to let Symfony decide. // Default: null
 *         status_code?: scalar|null|Param, // The status code of the response. Null or 0 to let Symfony decide. // Default: null
 *         log_channel?: scalar|null|Param, // The channel of log message. Null to let Symfony decide. // Default: null
 *     }>,
 *     web_link?: bool|array{ // Web links configuration
 *         enabled?: bool|Param, // Default: false
 *     },
 *     lock?: bool|string|array{ // Lock configuration
 *         enabled?: bool|Param, // Default: false
 *         resources?: array<string, string|list<scalar|null|Param>>,
 *     },
 *     semaphore?: bool|string|array{ // Semaphore configuration
 *         enabled?: bool|Param, // Default: false
 *         resources?: array<string, scalar|null|Param>,
 *     },
 *     messenger?: bool|array{ // Messenger configuration
 *         enabled?: bool|Param, // Default: false
 *         routing?: array<string, array{ // Default: []
 *             senders?: list<scalar|null|Param>,
 *         }>,
 *         serializer?: array{
 *             default_serializer?: scalar|null|Param, // Service id to use as the default serializer for the transports. // Default: "messenger.transport.native_php_serializer"
 *             symfony_serializer?: array{
 *                 format?: scalar|null|Param, // Serialization format for the messenger.transport.symfony_serializer service (which is not the serializer used by default). // Default: "json"
 *                 context?: array<string, mixed>,
 *             },
 *         },
 *         transports?: array<string, string|array{ // Default: []
 *             dsn?: scalar|null|Param,
 *             serializer?: scalar|null|Param, // Service id of a custom serializer to use. // Default: null
 *             options?: list<mixed>,
 *             failure_transport?: scalar|null|Param, // Transport name to send failed messages to (after all retries have failed). // Default: null
 *             retry_strategy?: string|array{
 *                 service?: scalar|null|Param, // Service id to override the retry strategy entirely. // Default: null
 *                 max_retries?: int|Param, // Default: 3
 *                 delay?: int|Param, // Time in ms to delay (or the initial value when multiplier is used). // Default: 1000
 *                 multiplier?: float|Param, // If greater than 1, delay will grow exponentially for each retry: this delay = (delay * (multiple ^ retries)). // Default: 2
 *                 max_delay?: int|Param, // Max time in ms that a retry should ever be delayed (0 = infinite). // Default: 0
 *                 jitter?: float|Param, // Randomness to apply to the delay (between 0 and 1). // Default: 0.1
 *             },
 *             rate_limiter?: scalar|null|Param, // Rate limiter name to use when processing messages. // Default: null
 *         }>,
 *         failure_transport?: scalar|null|Param, // Transport name to send failed messages to (after all retries have failed). // Default: null
 *         stop_worker_on_signals?: list<scalar|null|Param>,
 *         default_bus?: scalar|null|Param, // Default: null
 *         buses?: array<string, array{ // Default: {"messenger.bus.default":{"default_middleware":{"enabled":true,"allow_no_handlers":false,"allow_no_senders":true},"middleware":[]}}
 *             default_middleware?: bool|string|array{
 *                 enabled?: bool|Param, // Default: true
 *                 allow_no_handlers?: bool|Param, // Default: false
 *                 allow_no_senders?: bool|Param, // Default: true
 *             },
 *             middleware?: list<string|array{ // Default: []
 *                 id: scalar|null|Param,
 *                 arguments?: list<mixed>,
 *             }>,
 *         }>,
 *     },
 *     scheduler?: bool|array{ // Scheduler configuration
 *         enabled?: bool|Param, // Default: false
 *     },
 *     disallow_search_engine_index?: bool|Param, // Enabled by default when debug is enabled. // Default: true
 *     http_client?: bool|array{ // HTTP Client configuration
 *         enabled?: bool|Param, // Default: true
 *         max_host_connections?: int|Param, // The maximum number of connections to a single host.
 *         default_options?: array{
 *             headers?: array<string, mixed>,
 *             vars?: array<string, mixed>,
 *             max_redirects?: int|Param, // The maximum number of redirects to follow.
 *             http_version?: scalar|null|Param, // The default HTTP version, typically 1.1 or 2.0, leave to null for the best version.
 *             resolve?: array<string, scalar|null|Param>,
 *             proxy?: scalar|null|Param, // The URL of the proxy to pass requests through or null for automatic detection.
 *             no_proxy?: scalar|null|Param, // A comma separated list of hosts that do not require a proxy to be reached.
 *             timeout?: float|Param, // The idle timeout, defaults to the "default_socket_timeout" ini parameter.
 *             max_duration?: float|Param, // The maximum execution time for the request+response as a whole.
 *             bindto?: scalar|null|Param, // A network interface name, IP address, a host name or a UNIX socket to bind to.
 *             verify_peer?: bool|Param, // Indicates if the peer should be verified in a TLS context.
 *             verify_host?: bool|Param, // Indicates if the host should exist as a certificate common name.
 *             cafile?: scalar|null|Param, // A certificate authority file.
 *             capath?: scalar|null|Param, // A directory that contains multiple certificate authority files.
 *             local_cert?: scalar|null|Param, // A PEM formatted certificate file.
 *             local_pk?: scalar|null|Param, // A private key file.
 *             passphrase?: scalar|null|Param, // The passphrase used to encrypt the "local_pk" file.
 *             ciphers?: scalar|null|Param, // A list of TLS ciphers separated by colons, commas or spaces (e.g. "RC3-SHA:TLS13-AES-128-GCM-SHA256"...)
 *             peer_fingerprint?: array{ // Associative array: hashing algorithm => hash(es).
 *                 sha1?: mixed,
 *                 pin-sha256?: mixed,
 *                 md5?: mixed,
 *             },
 *             crypto_method?: scalar|null|Param, // The minimum version of TLS to accept; must be one of STREAM_CRYPTO_METHOD_TLSv*_CLIENT constants.
 *             extra?: array<string, mixed>,
 *             rate_limiter?: scalar|null|Param, // Rate limiter name to use for throttling requests. // Default: null
 *             caching?: bool|array{ // Caching configuration.
 *                 enabled?: bool|Param, // Default: false
 *                 cache_pool?: string|Param, // The taggable cache pool to use for storing the responses. // Default: "cache.http_client"
 *                 shared?: bool|Param, // Indicates whether the cache is shared (public) or private. // Default: true
 *                 max_ttl?: int|Param, // The maximum TTL (in seconds) allowed for cached responses. Null means no cap. // Default: null
 *             },
 *             retry_failed?: bool|array{
 *                 enabled?: bool|Param, // Default: false
 *                 retry_strategy?: scalar|null|Param, // service id to override the retry strategy. // Default: null
 *                 http_codes?: array<string, array{ // Default: []
 *                     code?: int|Param,
 *                     methods?: list<string|Param>,
 *                 }>,
 *                 max_retries?: int|Param, // Default: 3
 *                 delay?: int|Param, // Time in ms to delay (or the initial value when multiplier is used). // Default: 1000
 *                 multiplier?: float|Param, // If greater than 1, delay will grow exponentially for each retry: delay * (multiple ^ retries). // Default: 2
 *                 max_delay?: int|Param, // Max time in ms that a retry should ever be delayed (0 = infinite). // Default: 0
 *                 jitter?: float|Param, // Randomness in percent (between 0 and 1) to apply to the delay. // Default: 0.1
 *             },
 *         },
 *         mock_response_factory?: scalar|null|Param, // The id of the service that should generate mock responses. It should be either an invokable or an iterable.
 *         scoped_clients?: array<string, string|array{ // Default: []
 *             scope?: scalar|null|Param, // The regular expression that the request URL must match before adding the other options. When none is provided, the base URI is used instead.
 *             base_uri?: scalar|null|Param, // The URI to resolve relative URLs, following rules in RFC 3985, section 2.
 *             auth_basic?: scalar|null|Param, // An HTTP Basic authentication "username:password".
 *             auth_bearer?: scalar|null|Param, // A token enabling HTTP Bearer authorization.
 *             auth_ntlm?: scalar|null|Param, // A "username:password" pair to use Microsoft NTLM authentication (requires the cURL extension).
 *             query?: array<string, scalar|null|Param>,
 *             headers?: array<string, mixed>,
 *             max_redirects?: int|Param, // The maximum number of redirects to follow.
 *             http_version?: scalar|null|Param, // The default HTTP version, typically 1.1 or 2.0, leave to null for the best version.
 *             resolve?: array<string, scalar|null|Param>,
 *             proxy?: scalar|null|Param, // The URL of the proxy to pass requests through or null for automatic detection.
 *             no_proxy?: scalar|null|Param, // A comma separated list of hosts that do not require a proxy to be reached.
 *             timeout?: float|Param, // The idle timeout, defaults to the "default_socket_timeout" ini parameter.
 *             max_duration?: float|Param, // The maximum execution time for the request+response as a whole.
 *             bindto?: scalar|null|Param, // A network interface name, IP address, a host name or a UNIX socket to bind to.
 *             verify_peer?: bool|Param, // Indicates if the peer should be verified in a TLS context.
 *             verify_host?: bool|Param, // Indicates if the host should exist as a certificate common name.
 *             cafile?: scalar|null|Param, // A certificate authority file.
 *             capath?: scalar|null|Param, // A directory that contains multiple certificate authority files.
 *             local_cert?: scalar|null|Param, // A PEM formatted certificate file.
 *             local_pk?: scalar|null|Param, // A private key file.
 *             passphrase?: scalar|null|Param, // The passphrase used to encrypt the "local_pk" file.
 *             ciphers?: scalar|null|Param, // A list of TLS ciphers separated by colons, commas or spaces (e.g. "RC3-SHA:TLS13-AES-128-GCM-SHA256"...).
 *             peer_fingerprint?: array{ // Associative array: hashing algorithm => hash(es).
 *                 sha1?: mixed,
 *                 pin-sha256?: mixed,
 *                 md5?: mixed,
 *             },
 *             crypto_method?: scalar|null|Param, // The minimum version of TLS to accept; must be one of STREAM_CRYPTO_METHOD_TLSv*_CLIENT constants.
 *             extra?: array<string, mixed>,
 *             rate_limiter?: scalar|null|Param, // Rate limiter name to use for throttling requests. // Default: null
 *             caching?: bool|array{ // Caching configuration.
 *                 enabled?: bool|Param, // Default: false
 *                 cache_pool?: string|Param, // The taggable cache pool to use for storing the responses. // Default: "cache.http_client"
 *                 shared?: bool|Param, // Indicates whether the cache is shared (public) or private. // Default: true
 *                 max_ttl?: int|Param, // The maximum TTL (in seconds) allowed for cached responses. Null means no cap. // Default: null
 *             },
 *             retry_failed?: bool|array{
 *                 enabled?: bool|Param, // Default: false
 *                 retry_strategy?: scalar|null|Param, // service id to override the retry strategy. // Default: null
 *                 http_codes?: array<string, array{ // Default: []
 *                     code?: int|Param,
 *                     methods?: list<string|Param>,
 *                 }>,
 *                 max_retries?: int|Param, // Default: 3
 *                 delay?: int|Param, // Time in ms to delay (or the initial value when multiplier is used). // Default: 1000
 *                 multiplier?: float|Param, // If greater than 1, delay will grow exponentially for each retry: delay * (multiple ^ retries). // Default: 2
 *                 max_delay?: int|Param, // Max time in ms that a retry should ever be delayed (0 = infinite). // Default: 0
 *                 jitter?: float|Param, // Randomness in percent (between 0 and 1) to apply to the delay. // Default: 0.1
 *             },
 *         }>,
 *     },
 *     mailer?: bool|array{ // Mailer configuration
 *         enabled?: bool|Param, // Default: true
 *         message_bus?: scalar|null|Param, // The message bus to use. Defaults to the default bus if the Messenger component is installed. // Default: null
 *         dsn?: scalar|null|Param, // Default: null
 *         transports?: array<string, scalar|null|Param>,
 *         envelope?: array{ // Mailer Envelope configuration
 *             sender?: scalar|null|Param,
 *             recipients?: list<scalar|null|Param>,
 *             allowed_recipients?: list<scalar|null|Param>,
 *         },
 *         headers?: array<string, string|array{ // Default: []
 *             value?: mixed,
 *         }>,
 *         dkim_signer?: bool|array{ // DKIM signer configuration
 *             enabled?: bool|Param, // Default: false
 *             key?: scalar|null|Param, // Key content, or path to key (in PEM format with the `file://` prefix) // Default: ""
 *             domain?: scalar|null|Param, // Default: ""
 *             select?: scalar|null|Param, // Default: ""
 *             passphrase?: scalar|null|Param, // The private key passphrase // Default: ""
 *             options?: array<string, mixed>,
 *         },
 *         smime_signer?: bool|array{ // S/MIME signer configuration
 *             enabled?: bool|Param, // Default: false
 *             key?: scalar|null|Param, // Path to key (in PEM format) // Default: ""
 *             certificate?: scalar|null|Param, // Path to certificate (in PEM format without the `file://` prefix) // Default: ""
 *             passphrase?: scalar|null|Param, // The private key passphrase // Default: null
 *             extra_certificates?: scalar|null|Param, // Default: null
 *             sign_options?: int|Param, // Default: null
 *         },
 *         smime_encrypter?: bool|array{ // S/MIME encrypter configuration
 *             enabled?: bool|Param, // Default: false
 *             repository?: scalar|null|Param, // S/MIME certificate repository service. This service shall implement the `Symfony\Component\Mailer\EventListener\SmimeCertificateRepositoryInterface`. // Default: ""
 *             cipher?: int|Param, // A set of algorithms used to encrypt the message // Default: null
 *         },
 *     },
 *     secrets?: bool|array{
 *         enabled?: bool|Param, // Default: true
 *         vault_directory?: scalar|null|Param, // Default: "%kernel.project_dir%/config/secrets/%kernel.runtime_environment%"
 *         local_dotenv_file?: scalar|null|Param, // Default: "%kernel.project_dir%/.env.%kernel.runtime_environment%.local"
 *         decryption_env_var?: scalar|null|Param, // Default: "base64:default::SYMFONY_DECRYPTION_SECRET"
 *     },
 *     notifier?: bool|array{ // Notifier configuration
 *         enabled?: bool|Param, // Default: false
 *         message_bus?: scalar|null|Param, // The message bus to use. Defaults to the default bus if the Messenger component is installed. // Default: null
 *         chatter_transports?: array<string, scalar|null|Param>,
 *         texter_transports?: array<string, scalar|null|Param>,
 *         notification_on_failed_messages?: bool|Param, // Default: false
 *         channel_policy?: array<string, string|list<scalar|null|Param>>,
 *         admin_recipients?: list<array{ // Default: []
 *             email?: scalar|null|Param,
 *             phone?: scalar|null|Param, // Default: ""
 *         }>,
 *     },
 *     rate_limiter?: bool|array{ // Rate limiter configuration
 *         enabled?: bool|Param, // Default: false
 *         limiters?: array<string, array{ // Default: []
 *             lock_factory?: scalar|null|Param, // The service ID of the lock factory used by this limiter (or null to disable locking). // Default: "auto"
 *             cache_pool?: scalar|null|Param, // The cache pool to use for storing the current limiter state. // Default: "cache.rate_limiter"
 *             storage_service?: scalar|null|Param, // The service ID of a custom storage implementation, this precedes any configured "cache_pool". // Default: null
 *             policy: "fixed_window"|"token_bucket"|"sliding_window"|"compound"|"no_limit"|Param, // The algorithm to be used by this limiter.
 *             limiters?: list<scalar|null|Param>,
 *             limit?: int|Param, // The maximum allowed hits in a fixed interval or burst.
 *             interval?: scalar|null|Param, // Configures the fixed interval if "policy" is set to "fixed_window" or "sliding_window". The value must be a number followed by "second", "minute", "hour", "day", "week" or "month" (or their plural equivalent).
 *             rate?: array{ // Configures the fill rate if "policy" is set to "token_bucket".
 *                 interval?: scalar|null|Param, // Configures the rate interval. The value must be a number followed by "second", "minute", "hour", "day", "week" or "month" (or their plural equivalent).
 *                 amount?: int|Param, // Amount of tokens to add each interval. // Default: 1
 *             },
 *         }>,
 *     },
 *     uid?: bool|array{ // Uid configuration
 *         enabled?: bool|Param, // Default: false
 *         default_uuid_version?: 7|6|4|1|Param, // Default: 7
 *         name_based_uuid_version?: 5|3|Param, // Default: 5
 *         name_based_uuid_namespace?: scalar|null|Param,
 *         time_based_uuid_version?: 7|6|1|Param, // Default: 7
 *         time_based_uuid_node?: scalar|null|Param,
 *     },
 *     html_sanitizer?: bool|array{ // HtmlSanitizer configuration
 *         enabled?: bool|Param, // Default: true
 *         sanitizers?: array<string, array{ // Default: []
 *             allow_safe_elements?: bool|Param, // Allows "safe" elements and attributes. // Default: false
 *             allow_static_elements?: bool|Param, // Allows all static elements and attributes from the W3C Sanitizer API standard. // Default: false
 *             allow_elements?: array<string, mixed>,
 *             block_elements?: list<string|Param>,
 *             drop_elements?: list<string|Param>,
 *             allow_attributes?: array<string, mixed>,
 *             drop_attributes?: array<string, mixed>,
 *             force_attributes?: array<string, array<string, string|Param>>,
 *             force_https_urls?: bool|Param, // Transforms URLs using the HTTP scheme to use the HTTPS scheme instead. // Default: false
 *             allowed_link_schemes?: list<string|Param>,
 *             allowed_link_hosts?: list<string|Param>|null,
 *             allow_relative_links?: bool|Param, // Allows relative URLs to be used in links href attributes. // Default: false
 *             allowed_media_schemes?: list<string|Param>,
 *             allowed_media_hosts?: list<string|Param>|null,
 *             allow_relative_medias?: bool|Param, // Allows relative URLs to be used in media source attributes (img, audio, video, ...). // Default: false
 *             with_attribute_sanitizers?: list<string|Param>,
 *             without_attribute_sanitizers?: list<string|Param>,
 *             max_input_length?: int|Param, // The maximum length allowed for the sanitized input. // Default: 0
 *         }>,
 *     },
 *     webhook?: bool|array{ // Webhook configuration
 *         enabled?: bool|Param, // Default: false
 *         message_bus?: scalar|null|Param, // The message bus to use. // Default: "messenger.default_bus"
 *         routing?: array<string, array{ // Default: []
 *             service: scalar|null|Param,
 *             secret?: scalar|null|Param, // Default: ""
 *         }>,
 *     },
 *     remote-event?: bool|array{ // RemoteEvent configuration
 *         enabled?: bool|Param, // Default: false
 *     },
 *     json_streamer?: bool|array{ // JSON streamer configuration
 *         enabled?: bool|Param, // Default: false
 *     },
 * }
 * @psalm-type SecurityConfig = array{
 *     access_denied_url?: scalar|null|Param, // Default: null
 *     session_fixation_strategy?: "none"|"migrate"|"invalidate"|Param, // Default: "migrate"
 *     expose_security_errors?: \Symfony\Component\Security\Http\Authentication\ExposeSecurityLevel::None|\Symfony\Component\Security\Http\Authentication\ExposeSecurityLevel::AccountStatus|\Symfony\Component\Security\Http\Authentication\ExposeSecurityLevel::All|Param, // Default: "none"
 *     erase_credentials?: bool|Param, // Default: true
 *     access_decision_manager?: array{
 *         strategy?: "affirmative"|"consensus"|"unanimous"|"priority"|Param,
 *         service?: scalar|null|Param,
 *         strategy_service?: scalar|null|Param,
 *         allow_if_all_abstain?: bool|Param, // Default: false
 *         allow_if_equal_granted_denied?: bool|Param, // Default: true
 *     },
 *     password_hashers?: array<string, string|array{ // Default: []
 *         algorithm?: scalar|null|Param,
 *         migrate_from?: list<scalar|null|Param>,
 *         hash_algorithm?: scalar|null|Param, // Name of hashing algorithm for PBKDF2 (i.e. sha256, sha512, etc..) See hash_algos() for a list of supported algorithms. // Default: "sha512"
 *         key_length?: scalar|null|Param, // Default: 40
 *         ignore_case?: bool|Param, // Default: false
 *         encode_as_base64?: bool|Param, // Default: true
 *         iterations?: scalar|null|Param, // Default: 5000
 *         cost?: int|Param, // Default: null
 *         memory_cost?: scalar|null|Param, // Default: null
 *         time_cost?: scalar|null|Param, // Default: null
 *         id?: scalar|null|Param,
 *     }>,
 *     providers?: array<string, array{ // Default: []
 *         id?: scalar|null|Param,
 *         chain?: array{
 *             providers?: list<scalar|null|Param>,
 *         },
 *         memory?: array{
 *             users?: array<string, array{ // Default: []
 *                 password?: scalar|null|Param, // Default: null
 *                 roles?: list<scalar|null|Param>,
 *             }>,
 *         },
 *         ldap?: array{
 *             service: scalar|null|Param,
 *             base_dn: scalar|null|Param,
 *             search_dn?: scalar|null|Param, // Default: null
 *             search_password?: scalar|null|Param, // Default: null
 *             extra_fields?: list<scalar|null|Param>,
 *             default_roles?: list<scalar|null|Param>,
 *             role_fetcher?: scalar|null|Param, // Default: null
 *             uid_key?: scalar|null|Param, // Default: "sAMAccountName"
 *             filter?: scalar|null|Param, // Default: "({uid_key}={user_identifier})"
 *             password_attribute?: scalar|null|Param, // Default: null
 *         },
 *         entity?: array{
 *             class: scalar|null|Param, // The full entity class name of your user class.
 *             property?: scalar|null|Param, // Default: null
 *             manager_name?: scalar|null|Param, // Default: null
 *         },
 *     }>,
 *     firewalls: array<string, array{ // Default: []
 *         pattern?: scalar|null|Param,
 *         host?: scalar|null|Param,
 *         methods?: list<scalar|null|Param>,
 *         security?: bool|Param, // Default: true
 *         user_checker?: scalar|null|Param, // The UserChecker to use when authenticating users in this firewall. // Default: "security.user_checker"
 *         request_matcher?: scalar|null|Param,
 *         access_denied_url?: scalar|null|Param,
 *         access_denied_handler?: scalar|null|Param,
 *         entry_point?: scalar|null|Param, // An enabled authenticator name or a service id that implements "Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface".
 *         provider?: scalar|null|Param,
 *         stateless?: bool|Param, // Default: false
 *         lazy?: bool|Param, // Default: false
 *         context?: scalar|null|Param,
 *         logout?: array{
 *             enable_csrf?: bool|null|Param, // Default: null
 *             csrf_token_id?: scalar|null|Param, // Default: "logout"
 *             csrf_parameter?: scalar|null|Param, // Default: "_csrf_token"
 *             csrf_token_manager?: scalar|null|Param,
 *             path?: scalar|null|Param, // Default: "/logout"
 *             target?: scalar|null|Param, // Default: "/"
 *             invalidate_session?: bool|Param, // Default: true
 *             clear_site_data?: list<"*"|"cache"|"cookies"|"storage"|"executionContexts"|Param>,
 *             delete_cookies?: array<string, array{ // Default: []
 *                 path?: scalar|null|Param, // Default: null
 *                 domain?: scalar|null|Param, // Default: null
 *                 secure?: scalar|null|Param, // Default: false
 *                 samesite?: scalar|null|Param, // Default: null
 *                 partitioned?: scalar|null|Param, // Default: false
 *             }>,
 *         },
 *         switch_user?: array{
 *             provider?: scalar|null|Param,
 *             parameter?: scalar|null|Param, // Default: "_switch_user"
 *             role?: scalar|null|Param, // Default: "ROLE_ALLOWED_TO_SWITCH"
 *             target_route?: scalar|null|Param, // Default: null
 *         },
 *         required_badges?: list<scalar|null|Param>,
 *         custom_authenticators?: list<scalar|null|Param>,
 *         login_throttling?: array{
 *             limiter?: scalar|null|Param, // A service id implementing "Symfony\Component\HttpFoundation\RateLimiter\RequestRateLimiterInterface".
 *             max_attempts?: int|Param, // Default: 5
 *             interval?: scalar|null|Param, // Default: "1 minute"
 *             lock_factory?: scalar|null|Param, // The service ID of the lock factory used by the login rate limiter (or null to disable locking). // Default: null
 *             cache_pool?: string|Param, // The cache pool to use for storing the limiter state // Default: "cache.rate_limiter"
 *             storage_service?: string|Param, // The service ID of a custom storage implementation, this precedes any configured "cache_pool" // Default: null
 *         },
 *         x509?: array{
 *             provider?: scalar|null|Param,
 *             user?: scalar|null|Param, // Default: "SSL_CLIENT_S_DN_Email"
 *             credentials?: scalar|null|Param, // Default: "SSL_CLIENT_S_DN"
 *             user_identifier?: scalar|null|Param, // Default: "emailAddress"
 *         },
 *         remote_user?: array{
 *             provider?: scalar|null|Param,
 *             user?: scalar|null|Param, // Default: "REMOTE_USER"
 *         },
 *         login_link?: array{
 *             check_route: scalar|null|Param, // Route that will validate the login link - e.g. "app_login_link_verify".
 *             check_post_only?: scalar|null|Param, // If true, only HTTP POST requests to "check_route" will be handled by the authenticator. // Default: false
 *             signature_properties: list<scalar|null|Param>,
 *             lifetime?: int|Param, // The lifetime of the login link in seconds. // Default: 600
 *             max_uses?: int|Param, // Max number of times a login link can be used - null means unlimited within lifetime. // Default: null
 *             used_link_cache?: scalar|null|Param, // Cache service id used to expired links of max_uses is set.
 *             success_handler?: scalar|null|Param, // A service id that implements Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface.
 *             failure_handler?: scalar|null|Param, // A service id that implements Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface.
 *             provider?: scalar|null|Param, // The user provider to load users from.
 *             secret?: scalar|null|Param, // Default: "%kernel.secret%"
 *             always_use_default_target_path?: bool|Param, // Default: false
 *             default_target_path?: scalar|null|Param, // Default: "/"
 *             login_path?: scalar|null|Param, // Default: "/login"
 *             target_path_parameter?: scalar|null|Param, // Default: "_target_path"
 *             use_referer?: bool|Param, // Default: false
 *             failure_path?: scalar|null|Param, // Default: null
 *             failure_forward?: bool|Param, // Default: false
 *             failure_path_parameter?: scalar|null|Param, // Default: "_failure_path"
 *         },
 *         form_login?: array{
 *             provider?: scalar|null|Param,
 *             remember_me?: bool|Param, // Default: true
 *             success_handler?: scalar|null|Param,
 *             failure_handler?: scalar|null|Param,
 *             check_path?: scalar|null|Param, // Default: "/login_check"
 *             use_forward?: bool|Param, // Default: false
 *             login_path?: scalar|null|Param, // Default: "/login"
 *             username_parameter?: scalar|null|Param, // Default: "_username"
 *             password_parameter?: scalar|null|Param, // Default: "_password"
 *             csrf_parameter?: scalar|null|Param, // Default: "_csrf_token"
 *             csrf_token_id?: scalar|null|Param, // Default: "authenticate"
 *             enable_csrf?: bool|Param, // Default: false
 *             post_only?: bool|Param, // Default: true
 *             form_only?: bool|Param, // Default: false
 *             always_use_default_target_path?: bool|Param, // Default: false
 *             default_target_path?: scalar|null|Param, // Default: "/"
 *             target_path_parameter?: scalar|null|Param, // Default: "_target_path"
 *             use_referer?: bool|Param, // Default: false
 *             failure_path?: scalar|null|Param, // Default: null
 *             failure_forward?: bool|Param, // Default: false
 *             failure_path_parameter?: scalar|null|Param, // Default: "_failure_path"
 *         },
 *         form_login_ldap?: array{
 *             provider?: scalar|null|Param,
 *             remember_me?: bool|Param, // Default: true
 *             success_handler?: scalar|null|Param,
 *             failure_handler?: scalar|null|Param,
 *             check_path?: scalar|null|Param, // Default: "/login_check"
 *             use_forward?: bool|Param, // Default: false
 *             login_path?: scalar|null|Param, // Default: "/login"
 *             username_parameter?: scalar|null|Param, // Default: "_username"
 *             password_parameter?: scalar|null|Param, // Default: "_password"
 *             csrf_parameter?: scalar|null|Param, // Default: "_csrf_token"
 *             csrf_token_id?: scalar|null|Param, // Default: "authenticate"
 *             enable_csrf?: bool|Param, // Default: false
 *             post_only?: bool|Param, // Default: true
 *             form_only?: bool|Param, // Default: false
 *             always_use_default_target_path?: bool|Param, // Default: false
 *             default_target_path?: scalar|null|Param, // Default: "/"
 *             target_path_parameter?: scalar|null|Param, // Default: "_target_path"
 *             use_referer?: bool|Param, // Default: false
 *             failure_path?: scalar|null|Param, // Default: null
 *             failure_forward?: bool|Param, // Default: false
 *             failure_path_parameter?: scalar|null|Param, // Default: "_failure_path"
 *             service?: scalar|null|Param, // Default: "ldap"
 *             dn_string?: scalar|null|Param, // Default: "{user_identifier}"
 *             query_string?: scalar|null|Param,
 *             search_dn?: scalar|null|Param, // Default: ""
 *             search_password?: scalar|null|Param, // Default: ""
 *         },
 *         json_login?: array{
 *             provider?: scalar|null|Param,
 *             remember_me?: bool|Param, // Default: true
 *             success_handler?: scalar|null|Param,
 *             failure_handler?: scalar|null|Param,
 *             check_path?: scalar|null|Param, // Default: "/login_check"
 *             use_forward?: bool|Param, // Default: false
 *             login_path?: scalar|null|Param, // Default: "/login"
 *             username_path?: scalar|null|Param, // Default: "username"
 *             password_path?: scalar|null|Param, // Default: "password"
 *         },
 *         json_login_ldap?: array{
 *             provider?: scalar|null|Param,
 *             remember_me?: bool|Param, // Default: true
 *             success_handler?: scalar|null|Param,
 *             failure_handler?: scalar|null|Param,
 *             check_path?: scalar|null|Param, // Default: "/login_check"
 *             use_forward?: bool|Param, // Default: false
 *             login_path?: scalar|null|Param, // Default: "/login"
 *             username_path?: scalar|null|Param, // Default: "username"
 *             password_path?: scalar|null|Param, // Default: "password"
 *             service?: scalar|null|Param, // Default: "ldap"
 *             dn_string?: scalar|null|Param, // Default: "{user_identifier}"
 *             query_string?: scalar|null|Param,
 *             search_dn?: scalar|null|Param, // Default: ""
 *             search_password?: scalar|null|Param, // Default: ""
 *         },
 *         access_token?: array{
 *             provider?: scalar|null|Param,
 *             remember_me?: bool|Param, // Default: true
 *             success_handler?: scalar|null|Param,
 *             failure_handler?: scalar|null|Param,
 *             realm?: scalar|null|Param, // Default: null
 *             token_extractors?: list<scalar|null|Param>,
 *             token_handler: string|array{
 *                 id?: scalar|null|Param,
 *                 oidc_user_info?: string|array{
 *                     base_uri: scalar|null|Param, // Base URI of the userinfo endpoint on the OIDC server, or the OIDC server URI to use the discovery (require "discovery" to be configured).
 *                     discovery?: array{ // Enable the OIDC discovery.
 *                         cache?: array{
 *                             id: scalar|null|Param, // Cache service id to use to cache the OIDC discovery configuration.
 *                         },
 *                     },
 *                     claim?: scalar|null|Param, // Claim which contains the user identifier (e.g. sub, email, etc.). // Default: "sub"
 *                     client?: scalar|null|Param, // HttpClient service id to use to call the OIDC server.
 *                 },
 *                 oidc?: array{
 *                     discovery?: array{ // Enable the OIDC discovery.
 *                         base_uri: list<scalar|null|Param>,
 *                         cache?: array{
 *                             id: scalar|null|Param, // Cache service id to use to cache the OIDC discovery configuration.
 *                         },
 *                     },
 *                     claim?: scalar|null|Param, // Claim which contains the user identifier (e.g.: sub, email..). // Default: "sub"
 *                     audience: scalar|null|Param, // Audience set in the token, for validation purpose.
 *                     issuers: list<scalar|null|Param>,
 *                     algorithms: list<scalar|null|Param>,
 *                     keyset?: scalar|null|Param, // JSON-encoded JWKSet used to sign the token (must contain a list of valid public keys).
 *                     encryption?: bool|array{
 *                         enabled?: bool|Param, // Default: false
 *                         enforce?: bool|Param, // When enabled, the token shall be encrypted. // Default: false
 *                         algorithms: list<scalar|null|Param>,
 *                         keyset: scalar|null|Param, // JSON-encoded JWKSet used to decrypt the token (must contain a list of valid private keys).
 *                     },
 *                 },
 *                 cas?: array{
 *                     validation_url: scalar|null|Param, // CAS server validation URL
 *                     prefix?: scalar|null|Param, // CAS prefix // Default: "cas"
 *                     http_client?: scalar|null|Param, // HTTP Client service // Default: null
 *                 },
 *                 oauth2?: scalar|null|Param,
 *             },
 *         },
 *         http_basic?: array{
 *             provider?: scalar|null|Param,
 *             realm?: scalar|null|Param, // Default: "Secured Area"
 *         },
 *         http_basic_ldap?: array{
 *             provider?: scalar|null|Param,
 *             realm?: scalar|null|Param, // Default: "Secured Area"
 *             service?: scalar|null|Param, // Default: "ldap"
 *             dn_string?: scalar|null|Param, // Default: "{user_identifier}"
 *             query_string?: scalar|null|Param,
 *             search_dn?: scalar|null|Param, // Default: ""
 *             search_password?: scalar|null|Param, // Default: ""
 *         },
 *         remember_me?: array{
 *             secret?: scalar|null|Param, // Default: "%kernel.secret%"
 *             service?: scalar|null|Param,
 *             user_providers?: list<scalar|null|Param>,
 *             catch_exceptions?: bool|Param, // Default: true
 *             signature_properties?: list<scalar|null|Param>,
 *             token_provider?: string|array{
 *                 service?: scalar|null|Param, // The service ID of a custom remember-me token provider.
 *                 doctrine?: bool|array{
 *                     enabled?: bool|Param, // Default: false
 *                     connection?: scalar|null|Param, // Default: null
 *                 },
 *             },
 *             token_verifier?: scalar|null|Param, // The service ID of a custom rememberme token verifier.
 *             name?: scalar|null|Param, // Default: "REMEMBERME"
 *             lifetime?: int|Param, // Default: 31536000
 *             path?: scalar|null|Param, // Default: "/"
 *             domain?: scalar|null|Param, // Default: null
 *             secure?: true|false|"auto"|Param, // Default: false
 *             httponly?: bool|Param, // Default: true
 *             samesite?: null|"lax"|"strict"|"none"|Param, // Default: null
 *             always_remember_me?: bool|Param, // Default: false
 *             remember_me_parameter?: scalar|null|Param, // Default: "_remember_me"
 *         },
 *     }>,
 *     access_control?: list<array{ // Default: []
 *         request_matcher?: scalar|null|Param, // Default: null
 *         requires_channel?: scalar|null|Param, // Default: null
 *         path?: scalar|null|Param, // Use the urldecoded format. // Default: null
 *         host?: scalar|null|Param, // Default: null
 *         port?: int|Param, // Default: null
 *         ips?: list<scalar|null|Param>,
 *         attributes?: array<string, scalar|null|Param>,
 *         route?: scalar|null|Param, // Default: null
 *         methods?: list<scalar|null|Param>,
 *         allow_if?: scalar|null|Param, // Default: null
 *         roles?: list<scalar|null|Param>,
 *     }>,
 *     role_hierarchy?: array<string, string|list<scalar|null|Param>>,
 * }
 * @psalm-type DoctrineConfig = array{
 *     dbal?: array{
 *         default_connection?: scalar|null|Param,
 *         types?: array<string, string|array{ // Default: []
 *             class: scalar|null|Param,
 *         }>,
 *         driver_schemes?: array<string, scalar|null|Param>,
 *         connections?: array<string, array{ // Default: []
 *             url?: scalar|null|Param, // A URL with connection information; any parameter value parsed from this string will override explicitly set parameters
 *             dbname?: scalar|null|Param,
 *             host?: scalar|null|Param, // Defaults to "localhost" at runtime.
 *             port?: scalar|null|Param, // Defaults to null at runtime.
 *             user?: scalar|null|Param, // Defaults to "root" at runtime.
 *             password?: scalar|null|Param, // Defaults to null at runtime.
 *             dbname_suffix?: scalar|null|Param, // Adds the given suffix to the configured database name, this option has no effects for the SQLite platform
 *             application_name?: scalar|null|Param,
 *             charset?: scalar|null|Param,
 *             path?: scalar|null|Param,
 *             memory?: bool|Param,
 *             unix_socket?: scalar|null|Param, // The unix socket to use for MySQL
 *             persistent?: bool|Param, // True to use as persistent connection for the ibm_db2 driver
 *             protocol?: scalar|null|Param, // The protocol to use for the ibm_db2 driver (default to TCPIP if omitted)
 *             service?: bool|Param, // True to use SERVICE_NAME as connection parameter instead of SID for Oracle
 *             servicename?: scalar|null|Param, // Overrules dbname parameter if given and used as SERVICE_NAME or SID connection parameter for Oracle depending on the service parameter.
 *             sessionMode?: scalar|null|Param, // The session mode to use for the oci8 driver
 *             server?: scalar|null|Param, // The name of a running database server to connect to for SQL Anywhere.
 *             default_dbname?: scalar|null|Param, // Override the default database (postgres) to connect to for PostgreSQL connexion.
 *             sslmode?: scalar|null|Param, // Determines whether or with what priority a SSL TCP/IP connection will be negotiated with the server for PostgreSQL.
 *             sslrootcert?: scalar|null|Param, // The name of a file containing SSL certificate authority (CA) certificate(s). If the file exists, the server's certificate will be verified to be signed by one of these authorities.
 *             sslcert?: scalar|null|Param, // The path to the SSL client certificate file for PostgreSQL.
 *             sslkey?: scalar|null|Param, // The path to the SSL client key file for PostgreSQL.
 *             sslcrl?: scalar|null|Param, // The file name of the SSL certificate revocation list for PostgreSQL.
 *             pooled?: bool|Param, // True to use a pooled server with the oci8/pdo_oracle driver
 *             MultipleActiveResultSets?: bool|Param, // Configuring MultipleActiveResultSets for the pdo_sqlsrv driver
 *             instancename?: scalar|null|Param, // Optional parameter, complete whether to add the INSTANCE_NAME parameter in the connection. It is generally used to connect to an Oracle RAC server to select the name of a particular instance.
 *             connectstring?: scalar|null|Param, // Complete Easy Connect connection descriptor, see https://docs.oracle.com/database/121/NETAG/naming.htm.When using this option, you will still need to provide the user and password parameters, but the other parameters will no longer be used. Note that when using this parameter, the getHost and getPort methods from Doctrine\DBAL\Connection will no longer function as expected.
 *             driver?: scalar|null|Param, // Default: "pdo_mysql"
 *             auto_commit?: bool|Param,
 *             schema_filter?: scalar|null|Param,
 *             logging?: bool|Param, // Default: true
 *             profiling?: bool|Param, // Default: true
 *             profiling_collect_backtrace?: bool|Param, // Enables collecting backtraces when profiling is enabled // Default: false
 *             profiling_collect_schema_errors?: bool|Param, // Enables collecting schema errors when profiling is enabled // Default: true
 *             server_version?: scalar|null|Param,
 *             idle_connection_ttl?: int|Param, // Default: 600
 *             driver_class?: scalar|null|Param,
 *             wrapper_class?: scalar|null|Param,
 *             keep_replica?: bool|Param,
 *             options?: array<string, mixed>,
 *             mapping_types?: array<string, scalar|null|Param>,
 *             default_table_options?: array<string, scalar|null|Param>,
 *             schema_manager_factory?: scalar|null|Param, // Default: "doctrine.dbal.default_schema_manager_factory"
 *             result_cache?: scalar|null|Param,
 *             replicas?: array<string, array{ // Default: []
 *                 url?: scalar|null|Param, // A URL with connection information; any parameter value parsed from this string will override explicitly set parameters
 *                 dbname?: scalar|null|Param,
 *                 host?: scalar|null|Param, // Defaults to "localhost" at runtime.
 *                 port?: scalar|null|Param, // Defaults to null at runtime.
 *                 user?: scalar|null|Param, // Defaults to "root" at runtime.
 *                 password?: scalar|null|Param, // Defaults to null at runtime.
 *                 dbname_suffix?: scalar|null|Param, // Adds the given suffix to the configured database name, this option has no effects for the SQLite platform
 *                 application_name?: scalar|null|Param,
 *                 charset?: scalar|null|Param,
 *                 path?: scalar|null|Param,
 *                 memory?: bool|Param,
 *                 unix_socket?: scalar|null|Param, // The unix socket to use for MySQL
 *                 persistent?: bool|Param, // True to use as persistent connection for the ibm_db2 driver
 *                 protocol?: scalar|null|Param, // The protocol to use for the ibm_db2 driver (default to TCPIP if omitted)
 *                 service?: bool|Param, // True to use SERVICE_NAME as connection parameter instead of SID for Oracle
 *                 servicename?: scalar|null|Param, // Overrules dbname parameter if given and used as SERVICE_NAME or SID connection parameter for Oracle depending on the service parameter.
 *                 sessionMode?: scalar|null|Param, // The session mode to use for the oci8 driver
 *                 server?: scalar|null|Param, // The name of a running database server to connect to for SQL Anywhere.
 *                 default_dbname?: scalar|null|Param, // Override the default database (postgres) to connect to for PostgreSQL connexion.
 *                 sslmode?: scalar|null|Param, // Determines whether or with what priority a SSL TCP/IP connection will be negotiated with the server for PostgreSQL.
 *                 sslrootcert?: scalar|null|Param, // The name of a file containing SSL certificate authority (CA) certificate(s). If the file exists, the server's certificate will be verified to be signed by one of these authorities.
 *                 sslcert?: scalar|null|Param, // The path to the SSL client certificate file for PostgreSQL.
 *                 sslkey?: scalar|null|Param, // The path to the SSL client key file for PostgreSQL.
 *                 sslcrl?: scalar|null|Param, // The file name of the SSL certificate revocation list for PostgreSQL.
 *                 pooled?: bool|Param, // True to use a pooled server with the oci8/pdo_oracle driver
 *                 MultipleActiveResultSets?: bool|Param, // Configuring MultipleActiveResultSets for the pdo_sqlsrv driver
 *                 instancename?: scalar|null|Param, // Optional parameter, complete whether to add the INSTANCE_NAME parameter in the connection. It is generally used to connect to an Oracle RAC server to select the name of a particular instance.
 *                 connectstring?: scalar|null|Param, // Complete Easy Connect connection descriptor, see https://docs.oracle.com/database/121/NETAG/naming.htm.When using this option, you will still need to provide the user and password parameters, but the other parameters will no longer be used. Note that when using this parameter, the getHost and getPort methods from Doctrine\DBAL\Connection will no longer function as expected.
 *             }>,
 *         }>,
 *     },
 *     orm?: array{
 *         default_entity_manager?: scalar|null|Param,
 *         enable_native_lazy_objects?: bool|Param, // Deprecated: The "enable_native_lazy_objects" option is deprecated and will be removed in DoctrineBundle 4.0, as native lazy objects are now always enabled. // Default: true
 *         controller_resolver?: bool|array{
 *             enabled?: bool|Param, // Default: true
 *             auto_mapping?: bool|Param, // Deprecated: The "doctrine.orm.controller_resolver.auto_mapping.auto_mapping" option is deprecated and will be removed in DoctrineBundle 4.0, as it only accepts `false` since 3.0. // Set to true to enable using route placeholders as lookup criteria when the primary key doesn't match the argument name // Default: false
 *             evict_cache?: bool|Param, // Set to true to fetch the entity from the database instead of using the cache, if any // Default: false
 *         },
 *         entity_managers?: array<string, array{ // Default: []
 *             query_cache_driver?: string|array{
 *                 type?: scalar|null|Param, // Default: null
 *                 id?: scalar|null|Param,
 *                 pool?: scalar|null|Param,
 *             },
 *             metadata_cache_driver?: string|array{
 *                 type?: scalar|null|Param, // Default: null
 *                 id?: scalar|null|Param,
 *                 pool?: scalar|null|Param,
 *             },
 *             result_cache_driver?: string|array{
 *                 type?: scalar|null|Param, // Default: null
 *                 id?: scalar|null|Param,
 *                 pool?: scalar|null|Param,
 *             },
 *             entity_listeners?: array{
 *                 entities?: array<string, array{ // Default: []
 *                     listeners?: array<string, array{ // Default: []
 *                         events?: list<array{ // Default: []
 *                             type?: scalar|null|Param,
 *                             method?: scalar|null|Param, // Default: null
 *                         }>,
 *                     }>,
 *                 }>,
 *             },
 *             connection?: scalar|null|Param,
 *             class_metadata_factory_name?: scalar|null|Param, // Default: "Doctrine\\ORM\\Mapping\\ClassMetadataFactory"
 *             default_repository_class?: scalar|null|Param, // Default: "Doctrine\\ORM\\EntityRepository"
 *             auto_mapping?: scalar|null|Param, // Default: false
 *             naming_strategy?: scalar|null|Param, // Default: "doctrine.orm.naming_strategy.default"
 *             quote_strategy?: scalar|null|Param, // Default: "doctrine.orm.quote_strategy.default"
 *             typed_field_mapper?: scalar|null|Param, // Default: "doctrine.orm.typed_field_mapper.default"
 *             entity_listener_resolver?: scalar|null|Param, // Default: null
 *             fetch_mode_subselect_batch_size?: scalar|null|Param,
 *             repository_factory?: scalar|null|Param, // Default: "doctrine.orm.container_repository_factory"
 *             schema_ignore_classes?: list<scalar|null|Param>,
 *             validate_xml_mapping?: bool|Param, // Set to "true" to opt-in to the new mapping driver mode that was added in Doctrine ORM 2.14 and will be mandatory in ORM 3.0. See https://github.com/doctrine/orm/pull/6728. // Default: false
 *             second_level_cache?: array{
 *                 region_cache_driver?: string|array{
 *                     type?: scalar|null|Param, // Default: null
 *                     id?: scalar|null|Param,
 *                     pool?: scalar|null|Param,
 *                 },
 *                 region_lock_lifetime?: scalar|null|Param, // Default: 60
 *                 log_enabled?: bool|Param, // Default: true
 *                 region_lifetime?: scalar|null|Param, // Default: 3600
 *                 enabled?: bool|Param, // Default: true
 *                 factory?: scalar|null|Param,
 *                 regions?: array<string, array{ // Default: []
 *                     cache_driver?: string|array{
 *                         type?: scalar|null|Param, // Default: null
 *                         id?: scalar|null|Param,
 *                         pool?: scalar|null|Param,
 *                     },
 *                     lock_path?: scalar|null|Param, // Default: "%kernel.cache_dir%/doctrine/orm/slc/filelock"
 *                     lock_lifetime?: scalar|null|Param, // Default: 60
 *                     type?: scalar|null|Param, // Default: "default"
 *                     lifetime?: scalar|null|Param, // Default: 0
 *                     service?: scalar|null|Param,
 *                     name?: scalar|null|Param,
 *                 }>,
 *                 loggers?: array<string, array{ // Default: []
 *                     name?: scalar|null|Param,
 *                     service?: scalar|null|Param,
 *                 }>,
 *             },
 *             hydrators?: array<string, scalar|null|Param>,
 *             mappings?: array<string, bool|string|array{ // Default: []
 *                 mapping?: scalar|null|Param, // Default: true
 *                 type?: scalar|null|Param,
 *                 dir?: scalar|null|Param,
 *                 alias?: scalar|null|Param,
 *                 prefix?: scalar|null|Param,
 *                 is_bundle?: bool|Param,
 *             }>,
 *             dql?: array{
 *                 string_functions?: array<string, scalar|null|Param>,
 *                 numeric_functions?: array<string, scalar|null|Param>,
 *                 datetime_functions?: array<string, scalar|null|Param>,
 *             },
 *             filters?: array<string, string|array{ // Default: []
 *                 class: scalar|null|Param,
 *                 enabled?: bool|Param, // Default: false
 *                 parameters?: array<string, mixed>,
 *             }>,
 *             identity_generation_preferences?: array<string, scalar|null|Param>,
 *         }>,
 *         resolve_target_entities?: array<string, scalar|null|Param>,
 *     },
 * }
 * @psalm-type MonologConfig = array{
 *     use_microseconds?: scalar|null|Param, // Default: true
 *     channels?: list<scalar|null|Param>,
 *     handlers?: array<string, array{ // Default: []
 *         type: scalar|null|Param,
 *         id?: scalar|null|Param,
 *         enabled?: bool|Param, // Default: true
 *         priority?: scalar|null|Param, // Default: 0
 *         level?: scalar|null|Param, // Default: "DEBUG"
 *         bubble?: bool|Param, // Default: true
 *         interactive_only?: bool|Param, // Default: false
 *         app_name?: scalar|null|Param, // Default: null
 *         include_stacktraces?: bool|Param, // Default: false
 *         process_psr_3_messages?: array{
 *             enabled?: bool|null|Param, // Default: null
 *             date_format?: scalar|null|Param,
 *             remove_used_context_fields?: bool|Param,
 *         },
 *         path?: scalar|null|Param, // Default: "%kernel.logs_dir%/%kernel.environment%.log"
 *         file_permission?: scalar|null|Param, // Default: null
 *         use_locking?: bool|Param, // Default: false
 *         filename_format?: scalar|null|Param, // Default: "{filename}-{date}"
 *         date_format?: scalar|null|Param, // Default: "Y-m-d"
 *         ident?: scalar|null|Param, // Default: false
 *         logopts?: scalar|null|Param, // Default: 1
 *         facility?: scalar|null|Param, // Default: "user"
 *         max_files?: scalar|null|Param, // Default: 0
 *         action_level?: scalar|null|Param, // Default: "WARNING"
 *         activation_strategy?: scalar|null|Param, // Default: null
 *         stop_buffering?: bool|Param, // Default: true
 *         passthru_level?: scalar|null|Param, // Default: null
 *         excluded_http_codes?: list<array{ // Default: []
 *             code?: scalar|null|Param,
 *             urls?: list<scalar|null|Param>,
 *         }>,
 *         accepted_levels?: list<scalar|null|Param>,
 *         min_level?: scalar|null|Param, // Default: "DEBUG"
 *         max_level?: scalar|null|Param, // Default: "EMERGENCY"
 *         buffer_size?: scalar|null|Param, // Default: 0
 *         flush_on_overflow?: bool|Param, // Default: false
 *         handler?: scalar|null|Param,
 *         url?: scalar|null|Param,
 *         exchange?: scalar|null|Param,
 *         exchange_name?: scalar|null|Param, // Default: "log"
 *         channel?: scalar|null|Param, // Default: null
 *         bot_name?: scalar|null|Param, // Default: "Monolog"
 *         use_attachment?: scalar|null|Param, // Default: true
 *         use_short_attachment?: scalar|null|Param, // Default: false
 *         include_extra?: scalar|null|Param, // Default: false
 *         icon_emoji?: scalar|null|Param, // Default: null
 *         webhook_url?: scalar|null|Param,
 *         exclude_fields?: list<scalar|null|Param>,
 *         token?: scalar|null|Param,
 *         region?: scalar|null|Param,
 *         source?: scalar|null|Param,
 *         use_ssl?: bool|Param, // Default: true
 *         user?: mixed,
 *         title?: scalar|null|Param, // Default: null
 *         host?: scalar|null|Param, // Default: null
 *         port?: scalar|null|Param, // Default: 514
 *         config?: list<scalar|null|Param>,
 *         members?: list<scalar|null|Param>,
 *         connection_string?: scalar|null|Param,
 *         timeout?: scalar|null|Param,
 *         time?: scalar|null|Param, // Default: 60
 *         deduplication_level?: scalar|null|Param, // Default: 400
 *         store?: scalar|null|Param, // Default: null
 *         connection_timeout?: scalar|null|Param,
 *         persistent?: bool|Param,
 *         message_type?: scalar|null|Param, // Default: 0
 *         parse_mode?: scalar|null|Param, // Default: null
 *         disable_webpage_preview?: bool|null|Param, // Default: null
 *         disable_notification?: bool|null|Param, // Default: null
 *         split_long_messages?: bool|Param, // Default: false
 *         delay_between_messages?: bool|Param, // Default: false
 *         topic?: int|Param, // Default: null
 *         factor?: int|Param, // Default: 1
 *         tags?: list<scalar|null|Param>,
 *         console_formatter_options?: mixed, // Default: []
 *         formatter?: scalar|null|Param,
 *         nested?: bool|Param, // Default: false
 *         publisher?: string|array{
 *             id?: scalar|null|Param,
 *             hostname?: scalar|null|Param,
 *             port?: scalar|null|Param, // Default: 12201
 *             chunk_size?: scalar|null|Param, // Default: 1420
 *             encoder?: "json"|"compressed_json"|Param,
 *         },
 *         mongodb?: string|array{
 *             id?: scalar|null|Param, // ID of a MongoDB\Client service
 *             uri?: scalar|null|Param,
 *             username?: scalar|null|Param,
 *             password?: scalar|null|Param,
 *             database?: scalar|null|Param, // Default: "monolog"
 *             collection?: scalar|null|Param, // Default: "logs"
 *         },
 *         elasticsearch?: string|array{
 *             id?: scalar|null|Param,
 *             hosts?: list<scalar|null|Param>,
 *             host?: scalar|null|Param,
 *             port?: scalar|null|Param, // Default: 9200
 *             transport?: scalar|null|Param, // Default: "Http"
 *             user?: scalar|null|Param, // Default: null
 *             password?: scalar|null|Param, // Default: null
 *         },
 *         index?: scalar|null|Param, // Default: "monolog"
 *         document_type?: scalar|null|Param, // Default: "logs"
 *         ignore_error?: scalar|null|Param, // Default: false
 *         redis?: string|array{
 *             id?: scalar|null|Param,
 *             host?: scalar|null|Param,
 *             password?: scalar|null|Param, // Default: null
 *             port?: scalar|null|Param, // Default: 6379
 *             database?: scalar|null|Param, // Default: 0
 *             key_name?: scalar|null|Param, // Default: "monolog_redis"
 *         },
 *         predis?: string|array{
 *             id?: scalar|null|Param,
 *             host?: scalar|null|Param,
 *         },
 *         from_email?: scalar|null|Param,
 *         to_email?: list<scalar|null|Param>,
 *         subject?: scalar|null|Param,
 *         content_type?: scalar|null|Param, // Default: null
 *         headers?: list<scalar|null|Param>,
 *         mailer?: scalar|null|Param, // Default: null
 *         email_prototype?: string|array{
 *             id: scalar|null|Param,
 *             method?: scalar|null|Param, // Default: null
 *         },
 *         verbosity_levels?: array{
 *             VERBOSITY_QUIET?: scalar|null|Param, // Default: "ERROR"
 *             VERBOSITY_NORMAL?: scalar|null|Param, // Default: "WARNING"
 *             VERBOSITY_VERBOSE?: scalar|null|Param, // Default: "NOTICE"
 *             VERBOSITY_VERY_VERBOSE?: scalar|null|Param, // Default: "INFO"
 *             VERBOSITY_DEBUG?: scalar|null|Param, // Default: "DEBUG"
 *         },
 *         channels?: string|array{
 *             type?: scalar|null|Param,
 *             elements?: list<scalar|null|Param>,
 *         },
 *     }>,
 * }
 * @psalm-type TwigConfig = array{
 *     form_themes?: list<scalar|null|Param>,
 *     globals?: array<string, array{ // Default: []
 *         id?: scalar|null|Param,
 *         type?: scalar|null|Param,
 *         value?: mixed,
 *     }>,
 *     autoescape_service?: scalar|null|Param, // Default: null
 *     autoescape_service_method?: scalar|null|Param, // Default: null
 *     cache?: scalar|null|Param, // Default: true
 *     charset?: scalar|null|Param, // Default: "%kernel.charset%"
 *     debug?: bool|Param, // Default: "%kernel.debug%"
 *     strict_variables?: bool|Param, // Default: "%kernel.debug%"
 *     auto_reload?: scalar|null|Param,
 *     optimizations?: int|Param,
 *     default_path?: scalar|null|Param, // The default path used to load templates. // Default: "%kernel.project_dir%/templates"
 *     file_name_pattern?: list<scalar|null|Param>,
 *     paths?: array<string, mixed>,
 *     date?: array{ // The default format options used by the date filter.
 *         format?: scalar|null|Param, // Default: "F j, Y H:i"
 *         interval_format?: scalar|null|Param, // Default: "%d days"
 *         timezone?: scalar|null|Param, // The timezone used when formatting dates, when set to null, the timezone returned by date_default_timezone_get() is used. // Default: null
 *     },
 *     number_format?: array{ // The default format options for the number_format filter.
 *         decimals?: int|Param, // Default: 0
 *         decimal_point?: scalar|null|Param, // Default: "."
 *         thousands_separator?: scalar|null|Param, // Default: ","
 *     },
 *     mailer?: array{
 *         html_to_text_converter?: scalar|null|Param, // A service implementing the "Symfony\Component\Mime\HtmlToTextConverter\HtmlToTextConverterInterface". // Default: null
 *     },
 * }
 * @psalm-type DebugConfig = array{
 *     max_items?: int|Param, // Max number of displayed items past the first level, -1 means no limit. // Default: 2500
 *     min_depth?: int|Param, // Minimum tree depth to clone all the items, 1 is default. // Default: 1
 *     max_string_length?: int|Param, // Max length of displayed strings, -1 means no limit. // Default: -1
 *     dump_destination?: scalar|null|Param, // A stream URL where dumps should be written to. // Default: null
 *     theme?: "dark"|"light"|Param, // Changes the color of the dump() output when rendered directly on the templating. "dark" (default) or "light". // Default: "dark"
 * }
 * @psalm-type WebProfilerConfig = array{
 *     toolbar?: bool|array{ // Profiler toolbar configuration
 *         enabled?: bool|Param, // Default: false
 *         ajax_replace?: bool|Param, // Replace toolbar on AJAX requests // Default: false
 *     },
 *     intercept_redirects?: bool|Param, // Default: false
 *     excluded_ajax_paths?: scalar|null|Param, // Default: "^/((index|app(_[\\w]+)?)\\.php/)?_wdt"
 * }
 * @psalm-type DamaDoctrineTestConfig = array{
 *     enable_static_connection?: mixed, // Default: true
 *     enable_static_meta_data_cache?: bool|Param, // Default: true
 *     enable_static_query_cache?: bool|Param, // Default: true
 *     connection_keys?: list<mixed>,
 * }
 * @psalm-type DoctrineMigrationsConfig = array{
 *     enable_service_migrations?: bool|Param, // Whether to enable fetching migrations from the service container. // Default: false
 *     migrations_paths?: array<string, scalar|null|Param>,
 *     services?: array<string, scalar|null|Param>,
 *     factories?: array<string, scalar|null|Param>,
 *     storage?: array{ // Storage to use for migration status metadata.
 *         table_storage?: array{ // The default metadata storage, implemented as a table in the database.
 *             table_name?: scalar|null|Param, // Default: null
 *             version_column_name?: scalar|null|Param, // Default: null
 *             version_column_length?: scalar|null|Param, // Default: null
 *             executed_at_column_name?: scalar|null|Param, // Default: null
 *             execution_time_column_name?: scalar|null|Param, // Default: null
 *         },
 *     },
 *     migrations?: list<scalar|null|Param>,
 *     connection?: scalar|null|Param, // Connection name to use for the migrations database. // Default: null
 *     em?: scalar|null|Param, // Entity manager name to use for the migrations database (available when doctrine/orm is installed). // Default: null
 *     all_or_nothing?: scalar|null|Param, // Run all migrations in a transaction. // Default: false
 *     check_database_platform?: scalar|null|Param, // Adds an extra check in the generated migrations to allow execution only on the same platform as they were initially generated on. // Default: true
 *     custom_template?: scalar|null|Param, // Custom template path for generated migration classes. // Default: null
 *     organize_migrations?: scalar|null|Param, // Organize migrations mode. Possible values are: "BY_YEAR", "BY_YEAR_AND_MONTH", false // Default: false
 *     enable_profiler?: bool|Param, // Whether or not to enable the profiler collector to calculate and visualize migration status. This adds some queries overhead. // Default: false
 *     transactional?: bool|Param, // Whether or not to wrap migrations in a single transaction. // Default: true
 * }
 * @psalm-type MakerConfig = array{
 *     root_namespace?: scalar|null|Param, // Default: "App"
 *     generate_final_classes?: bool|Param, // Default: true
 *     generate_final_entities?: bool|Param, // Default: false
 * }
 * @psalm-type TwigExtraConfig = array{
 *     cache?: bool|array{
 *         enabled?: bool|Param, // Default: false
 *     },
 *     html?: bool|array{
 *         enabled?: bool|Param, // Default: false
 *     },
 *     markdown?: bool|array{
 *         enabled?: bool|Param, // Default: true
 *     },
 *     intl?: bool|array{
 *         enabled?: bool|Param, // Default: true
 *     },
 *     cssinliner?: bool|array{
 *         enabled?: bool|Param, // Default: false
 *     },
 *     inky?: bool|array{
 *         enabled?: bool|Param, // Default: false
 *     },
 *     string?: bool|array{
 *         enabled?: bool|Param, // Default: false
 *     },
 *     commonmark?: array{
 *         renderer?: array{ // Array of options for rendering HTML.
 *             block_separator?: scalar|null|Param,
 *             inner_separator?: scalar|null|Param,
 *             soft_break?: scalar|null|Param,
 *         },
 *         html_input?: "strip"|"allow"|"escape"|Param, // How to handle HTML input.
 *         allow_unsafe_links?: bool|Param, // Remove risky link and image URLs by setting this to false. // Default: true
 *         max_nesting_level?: int|Param, // The maximum nesting level for blocks. // Default: 9223372036854775807
 *         max_delimiters_per_line?: int|Param, // The maximum number of strong/emphasis delimiters per line. // Default: 9223372036854775807
 *         slug_normalizer?: array{ // Array of options for configuring how URL-safe slugs are created.
 *             instance?: mixed,
 *             max_length?: int|Param, // Default: 255
 *             unique?: mixed,
 *         },
 *         commonmark?: array{ // Array of options for configuring the CommonMark core extension.
 *             enable_em?: bool|Param, // Default: true
 *             enable_strong?: bool|Param, // Default: true
 *             use_asterisk?: bool|Param, // Default: true
 *             use_underscore?: bool|Param, // Default: true
 *             unordered_list_markers?: list<scalar|null|Param>,
 *         },
 *         ...<mixed>
 *     },
 * }
 * @psalm-type TwigComponentConfig = array{
 *     defaults?: array<string, string|array{ // Default: ["__deprecated__use_old_naming_behavior"]
 *         template_directory?: scalar|null|Param, // Default: "components"
 *         name_prefix?: scalar|null|Param, // Default: ""
 *     }>,
 *     anonymous_template_directory?: scalar|null|Param, // Defaults to `components`
 *     profiler?: bool|array{ // Enables the profiler for Twig Component
 *         enabled?: bool|Param, // Default: "%kernel.debug%"
 *         collect_components?: bool|Param, // Collect components instances // Default: true
 *     },
 *     controllers_json?: scalar|null|Param, // Deprecated: The "twig_component.controllers_json" config option is deprecated, and will be removed in 3.0. // Default: null
 * }
 * @psalm-type LiveComponentConfig = array{
 *     secret?: scalar|null|Param, // The secret used to compute fingerprints and checksums // Default: "%kernel.secret%"
 * }
 * @psalm-type StimulusConfig = array{
 *     controller_paths?: list<scalar|null|Param>,
 *     controllers_json?: scalar|null|Param, // Default: "%kernel.project_dir%/assets/controllers.json"
 * }
 * @psalm-type SymfonycastsSassConfig = array{
 *     root_sass?: list<scalar|null|Param>,
 *     binary?: scalar|null|Param, // The Sass binary to use // Default: null
 *     sass_options?: array{
 *         style?: "compressed"|"expanded"|Param, // The style of the generated CSS: compressed or expanded. // Default: "expanded"
 *         charset?: bool|Param, // Whether to include the charset declaration in the generated Sass.
 *         error_css?: bool|Param, // Emit a CSS file when an error occurs.
 *         source_map?: bool|Param, // Whether to generate source maps. // Default: true
 *         embed_sources?: bool|Param, // Embed source file contents in source maps.
 *         embed_source_map?: bool|Param, // Embed source map contents in CSS. // Default: "%kernel.debug%"
 *         load_path?: list<scalar|null|Param>,
 *         quiet?: bool|Param, // Don't print warnings.
 *         quiet_deps?: bool|Param, // Don't print compiler warnings from dependencies.
 *         stop_on_error?: bool|Param, // Don't compile more files once an error is encountered.
 *         trace?: bool|Param, // Print full Dart stack traces for exceptions.
 *     },
 *     embed_sourcemap?: bool|null|Param, // Deprecated: Option "embed_sourcemap" at "symfonycasts_sass.embed_sourcemap" is deprecated. Use "sass_options.embed_source_map" instead". // Default: null
 * }
 * @psalm-type UxIconsConfig = array{
 *     icon_dir?: scalar|null|Param, // The local directory where icons are stored. // Default: "%kernel.project_dir%/assets/icons"
 *     default_icon_attributes?: array<string, scalar|null|Param>,
 *     icon_sets?: array<string, array{ // the icon set prefix (e.g. "acme") // Default: []
 *         path?: scalar|null|Param, // The local icon set directory path. (cannot be used with 'alias')
 *         alias?: scalar|null|Param, // The remote icon set identifier. (cannot be used with 'path')
 *         icon_attributes?: array<string, scalar|null|Param>,
 *     }>,
 *     aliases?: array<string, string|Param>,
 *     iconify?: bool|array{ // Configuration for the remote icon service.
 *         enabled?: bool|Param, // Default: true
 *         on_demand?: bool|Param, // Whether to download icons "on demand". // Default: true
 *         endpoint?: scalar|null|Param, // The endpoint for the Iconify icons API. // Default: "https://api.iconify.design"
 *     },
 *     ignore_not_found?: bool|Param, // Ignore error when an icon is not found. Set to 'true' to fail silently. // Default: false
 * }
 * @psalm-type ConfigType = array{
 *     imports?: ImportsConfig,
 *     parameters?: ParametersConfig,
 *     services?: ServicesConfig,
 *     framework?: FrameworkConfig,
 *     security?: SecurityConfig,
 *     doctrine?: DoctrineConfig,
 *     monolog?: MonologConfig,
 *     twig?: TwigConfig,
 *     doctrine_migrations?: DoctrineMigrationsConfig,
 *     twig_extra?: TwigExtraConfig,
 *     twig_component?: TwigComponentConfig,
 *     live_component?: LiveComponentConfig,
 *     stimulus?: StimulusConfig,
 *     symfonycasts_sass?: SymfonycastsSassConfig,
 *     ux_icons?: UxIconsConfig,
 *     "when@dev"?: array{
 *         imports?: ImportsConfig,
 *         parameters?: ParametersConfig,
 *         services?: ServicesConfig,
 *         framework?: FrameworkConfig,
 *         security?: SecurityConfig,
 *         doctrine?: DoctrineConfig,
 *         monolog?: MonologConfig,
 *         twig?: TwigConfig,
 *         debug?: DebugConfig,
 *         web_profiler?: WebProfilerConfig,
 *         doctrine_migrations?: DoctrineMigrationsConfig,
 *         maker?: MakerConfig,
 *         twig_extra?: TwigExtraConfig,
 *         twig_component?: TwigComponentConfig,
 *         live_component?: LiveComponentConfig,
 *         stimulus?: StimulusConfig,
 *         symfonycasts_sass?: SymfonycastsSassConfig,
 *         ux_icons?: UxIconsConfig,
 *     },
 *     "when@prod"?: array{
 *         imports?: ImportsConfig,
 *         parameters?: ParametersConfig,
 *         services?: ServicesConfig,
 *         framework?: FrameworkConfig,
 *         security?: SecurityConfig,
 *         doctrine?: DoctrineConfig,
 *         monolog?: MonologConfig,
 *         twig?: TwigConfig,
 *         doctrine_migrations?: DoctrineMigrationsConfig,
 *         twig_extra?: TwigExtraConfig,
 *         twig_component?: TwigComponentConfig,
 *         live_component?: LiveComponentConfig,
 *         stimulus?: StimulusConfig,
 *         symfonycasts_sass?: SymfonycastsSassConfig,
 *         ux_icons?: UxIconsConfig,
 *     },
 *     "when@test"?: array{
 *         imports?: ImportsConfig,
 *         parameters?: ParametersConfig,
 *         services?: ServicesConfig,
 *         framework?: FrameworkConfig,
 *         security?: SecurityConfig,
 *         doctrine?: DoctrineConfig,
 *         monolog?: MonologConfig,
 *         twig?: TwigConfig,
 *         web_profiler?: WebProfilerConfig,
 *         dama_doctrine_test?: DamaDoctrineTestConfig,
 *         doctrine_migrations?: DoctrineMigrationsConfig,
 *         twig_extra?: TwigExtraConfig,
 *         twig_component?: TwigComponentConfig,
 *         live_component?: LiveComponentConfig,
 *         stimulus?: StimulusConfig,
 *         symfonycasts_sass?: SymfonycastsSassConfig,
 *         ux_icons?: UxIconsConfig,
 *     },
 *     ...<string, ExtensionType|array{ // extra keys must follow the when@%env% pattern or match an extension alias
 *         imports?: ImportsConfig,
 *         parameters?: ParametersConfig,
 *         services?: ServicesConfig,
 *         ...<string, ExtensionType>,
 *     }>
 * }
 */
final class App
{
    /**
     * @param ConfigType $config
     *
     * @psalm-return ConfigType
     */
    public static function config(array $config): array
    {
        return AppReference::config($config);
    }
}

namespace Symfony\Component\Routing\Loader\Configurator;

/**
 * This class provides array-shapes for configuring the routes of an application.
 *
 * Example:
 *
 *     ```php
 *     // config/routes.php
 *     namespace Symfony\Component\Routing\Loader\Configurator;
 *
 *     return Routes::config([
 *         'controllers' => [
 *             'resource' => 'routing.controllers',
 *         ],
 *     ]);
 *     ```
 *
 * @psalm-type RouteConfig = array{
 *     path: string|array<string,string>,
 *     controller?: string,
 *     methods?: string|list<string>,
 *     requirements?: array<string,string>,
 *     defaults?: array<string,mixed>,
 *     options?: array<string,mixed>,
 *     host?: string|array<string,string>,
 *     schemes?: string|list<string>,
 *     condition?: string,
 *     locale?: string,
 *     format?: string,
 *     utf8?: bool,
 *     stateless?: bool,
 * }
 * @psalm-type ImportConfig = array{
 *     resource: string,
 *     type?: string,
 *     exclude?: string|list<string>,
 *     prefix?: string|array<string,string>,
 *     name_prefix?: string,
 *     trailing_slash_on_root?: bool,
 *     controller?: string,
 *     methods?: string|list<string>,
 *     requirements?: array<string,string>,
 *     defaults?: array<string,mixed>,
 *     options?: array<string,mixed>,
 *     host?: string|array<string,string>,
 *     schemes?: string|list<string>,
 *     condition?: string,
 *     locale?: string,
 *     format?: string,
 *     utf8?: bool,
 *     stateless?: bool,
 * }
 * @psalm-type AliasConfig = array{
 *     alias: string,
 *     deprecated?: array{package:string, version:string, message?:string},
 * }
 * @psalm-type RoutesConfig = array{
 *     "when@dev"?: array<string, RouteConfig|ImportConfig|AliasConfig>,
 *     "when@prod"?: array<string, RouteConfig|ImportConfig|AliasConfig>,
 *     "when@test"?: array<string, RouteConfig|ImportConfig|AliasConfig>,
 *     ...<string, RouteConfig|ImportConfig|AliasConfig>
 * }
 */
final class Routes
{
    /**
     * @param RoutesConfig $config
     *
     * @psalm-return RoutesConfig
     */
    public static function config(array $config): array
    {
        return $config;
    }
}
