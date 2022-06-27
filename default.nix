# This is a minimal `default.nix` by composer-plugin-nixify. You can customize
# it as needed, it will not be overwritten by the plugin.

{ pkgs ? import <nixpkgs> { } }:

pkgs.callPackage ./composer-project.nix { } ./.
