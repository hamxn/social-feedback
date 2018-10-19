### Ping to the business network
`composer card import -f ./admin@social-feedback.card`

`composer network ping -c admin@social-feedback`

### Upgrade to the business network
Update the version property of package.json from 0.0.1 to 0.0.2

`composer archive create -t dir -n .`

`composer network install -c admin@social-feedback -a social-feedback@0.0.2.bna`

`composer network upgrade -c admin@social-feedback -n social-feedback -V 0.0.2`

### Generating a REST server and a skeleton Angular application
`yo hyperledger-composer:angular`
	
	Do you want to connect to a running Business Network? Yes
    Description: social-feedback
    Author name: lftv
    Author email: lftv@lifull-tech.vn    
    License: Apache-2.0
    Name of the Business Network card: admin@social-feedback
    Do you want to generate a new REST API or connect to an existing REST API?  Generate a new REST API
    REST server port: 3000
    Should namespaces be used in the generated REST API? Never use namespaces

`cd social-feedback`

`npm start`

REST server `=> http://localhost:3000`

Angular application `=> http://localhost:4200`