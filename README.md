### Starting and stopping Hyperledger Fabric
stop    : `~/fabric-dev-servers/stopFabric.sh`

teardown: `~/fabric-dev-servers/teardownFabric.sh`

start   : `~/fabric-dev-servers/startFabric.sh`

### Generate a business network archive
`composer archive create -t dir -n .`

### Deploying the business network
`composer network install -c PeerAdmin@hlfv1 -a social-feedback@0.0.1.bna`

`composer network start -n social-feedback -V 0.0.1 -A admin -S adminpw -c PeerAdmin@hlfv1 -f networkadmin.card`

`composer card import -f networkadmin.card`

`composer network ping -c admin@social-feedback`

### Generating a REST server
`composer-rest-server`

	card name               : admin@social-feedback
	namespaces              : never use namespaces.
	secure the generated API: No
	using Passport          : No
	explorer test interface : Yes
	enable event publication: Yes
	enable TLS security     : No

### Generating a skeleton Angular application
`yo hyperledger-composer:angular`
	
	connect to running business network: Yes
	card name          : admin@social-feedback
	Connect to an existing REST API
	REST server address: http://localhost
	server port        : 3000
	namespaces         : Namespaces are not used.
`=> http://localhost:4200`