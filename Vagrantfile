# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|

  config.vm.box = "ubuntu16_64"
  config.vm.box_url = "https://budgens.staging.thepricingpeople.co.uk/box/package.box"
  config.vm.box_download_insecure = true
  config.ssh.private_key_path = ENV['VAGRANT_PRIVATE_KEY_PATH']
  config.ssh.forward_agent = true
  config.vm.network "forwarded_port", guest: 80, host: 4567
  config.vm.provision :shell, path: "vagrant-bootstrap.sh"

end
