{
  description = "PHP App demo";

  inputs.nixpkgs.url = "nixpkgs/nixpkgs-unstable";
  inputs.flake-utils.url = "github:numtide/flake-utils";

  outputs = { self, nixpkgs, flake-utils }: flake-utils.lib.eachDefaultSystem
    (system:
      let
        pkgs = import nixpkgs {
          inherit system;
        };

        name = "PHPApp";
        port = "8000"; # Must be a string
        public = "public";

        revision = "${self.lastModifiedDate}-${self.shortRev or "dirty"}";
        src = self;
        php = pkgs.php81;

        phpProject = pkgs.callPackage ./composer-project.nix {
          inherit php;
        } src;

        wrapper = pkgs.writeScriptBin name ''
          #!${pkgs.bash}/bin/bash
          export TMPDIR=$(dirname $(mktemp -u))
          export APP_CACHE_DIR=$TMPDIR/${name}
          export APP_LOG_DIR=$APP_CACHE_DIR/log
          ${php}/bin/php -S 0.0.0.0:${port} -t ${phpProject}/libexec/source/${public}
        '';

        phpApp = pkgs.stdenv.mkDerivation {
          inherit name;

          src = self;

          buildInputs = [
            pkgs.mktemp
            pkgs.coreutils
            phpProject
            wrapper
          ];

          installPhase = ''
            mkdir -p $out/bin
            cp -r ${wrapper}/bin/* $out/bin/
          '';
        };
      in
      {
        # Nix run
        defaultApp = phpApp;

        # Nix build
        packages = {
          oci = pkgs.dockerTools.buildLayeredImage {
            name = "symfony/demo";
            tag = revision;
            contents = [
              pkgs.mktemp
              pkgs.coreutils
              phpApp
            ];
            config = {
              Cmd = [ "${phpApp}/bin/PHPApp" ];
              ExposedPorts = {
                "${port}/tcp" = { };
              };
            };
          };
        };
      }
    );
}
