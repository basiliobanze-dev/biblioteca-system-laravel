self: super:
{
  php74 = super.callPackage (super.fetchFromGitHub {
    owner = "NixOS";
    repo = "nixpkgs";
    rev = "um-commit-antigo-com-php74"; # Substitua por um commit válido
    sha256 = "0000000000000000000000000000000000000000000000000000";
  }) {};
}