# Bussiness Network Application
## Deployment guide in local development
```bash
username@host-name:~/projects/social-feedback/bna$ 
composer archive create -a social-feedback@0.0.1.bna -t dir -n . -u yes
composer network install --archiveFile social-feedback@0.0.1.bna --card PeerAdmin@hlfv1
username@host-name:~/projects/social-feedback/bna$ composer network start --networkName social-feedback --networkVersion 0.0.1 --card PeerAdmin@hlfv1  --networkAdmin admin --networkAdminEnrollSecret adminpw
```