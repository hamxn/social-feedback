# Cổng tiếp nhận phản ánh người dân về ATTP
An toàn thực phẩm (ATTP) là vấn đề có tầm quan trọng đặc biệt, được tiếp cận với thực phẩm an toàn đang trở thành quyền cơ bản đối với mỗi con người. Thực phẩn toàn toàn đóng góp to lớn trong việc cải thiện sức khoẻ con người, chất lượng cuộc sống và chất lượng giống nòi. Ngộ độc thực phẩm và các bệnh do thực phẩm kém chất lượng gây ra không chỉ gây ảnh hưởng trực tiếp tới sức khoẻ và cuộc sống của mỗi người, mà còn gây thiệt hại lớn về kinh tế, là gánh nặng chi phí cho chăm sóc sức khoẻ. An toàn thực phẩm không chỉ ảnh hưởng trực tiếp, thường xuyên đến sức khoẻ mà còn liên quan chặt chẽ đến năng suất, hiệu quả phát triển kinh tế, thương mại, du lịch và an sinh xã hội. Đảm bảo an toàn thực phẩm góp phần quan trọng thúc đẩy phát triển kinh tế - xã hội, xoá đói giảm nghèo và hội nhập quốc tế.

Vệ sinh an toàn thực phẩm trên thế giới nói chung và của nước ta nói riêng đang tạo nhiều lo lắng cho người dân. Thực chất, nhiều sự kiện như việc tiếp tục sử dụng những hoá chất cấm dùng trong nuôi trồng, chế biến nông sản, thực phẩm; việc sản xuất một số sản phẩm kém chất lượng hoặc do quy trình chế biến hoặc do nhiễm độc từ môi trường,...đang gây ảnh hưởng xấu đến xuất khẩu và tiêu dùng. Các vụ ngộ độc thực phẩm tại một số bếp ăn tập thể, nhiều thông tin liên tục về tình hình ATVSTP ở một vài nước trên thế giới, cộng thêm dịch cúm gia cầm tái phát, bệnh heo tai xanh ở một số địa phương trong nước càng làm bùng lên sự lo âu của mọi chúng ta.

Công tác bảo đảm an toàn thực phẩm ở nước ta còn nhiều khó khăn, thách thức. Tình trạng ngộ độc thực. phẩm có xu hướng tăng và ảnh hưởng không nhỏ tới sức khoẻ cộng đồng. Sản xuất, kinh doanh thực phẩm ở nước ta cơ bản vẫn là nhỏ lẻ, quy mô hộ gia đình nên việc kiểm soát an toàn vệ sinh rất khó khăn. Mặc dù Việt Nam đã có những tiến bộ rõ rệt trong bảo đảm an toàn vệ sinh thực phẩm trong thời gian qua song công tác quản lý an toàn thực phẩm còn nhiều yếu kém, bất cập, hạn chế về nguồn lực và đầu tư kinh phí vã chưa đáp ứng được yêu cầu thực tiễn.

Thực chất đảm bảo VSATTP chỉ có thể giải quyết được tốt nếu có những biện pháp đồng bộ từ mọi người chúng ta, từ người quản lý, người sản xuất, đến người tiêu dùng điều phải đòng lòng thực hiện với mục tiêu giữ gìn sức khoẻ cho thế hệ chúng ta hôm nay và cả thế hệ con cháu chúng ta ngày mai. (Sở Nông nghiệp & PTNT)

Trên cơ sở tạo sự liên kết toàn dân để giải quyết vấn đề VSATTP, chúng tôi xây dựng một ứng dụng để có thể tiếp nhận kịp thời những phản ánh của người dân về vấn đề VSATTP, góp phần giải quyết những hạn chế về nguồn lực cũng như kinh phí giám sát.

Ở code này chúng tôi xây dựng một hệ thống tiếp nhận và phản hồi những phản ánh của người dân with Hyperledger Composer và demo thông qua Laravel web applicaiton. Ứng dụng sẽ thể hiện việc xử lý phản hồi phản ánh. Blockchain ở đây để đảm bảo việc xử lý những phản ánh được công khai minh bạch, mà ai cũng có thể kiểm tra.

Có 3 dashboard trong hệ thống. 
- Người dân là người có vai trò đưa ra những phản ánh. 
- Sở Y Tế là đơn vị tiếp nhận, xử lý, và cập nhật trạng thái phản ánh
- Bộ Y Tế là bên thứ bên đóng vai trò giám sát.

# Architecture Flow
![Architecture Flow](https://github.com/hamxn/social-feedback/blob/master/flow.png)

1. Người dân gửi phản ánh đến hệ thống blockchain.
2. Sở Y Tế tiếp nhận phản ánh
3. Sở Y Tế xử lý phản ánh, update trạng thái vào cập nhận vào hệ thống blockchain.
4. Người dân verify trạng thái phản ánh từ hệ thống block chain.
5. Bộ Y Tế xem và kiểm tra toàn bộ chi tiết của quá trình xử lý phản ánh.

# Included Components
* [Hyperledger Composer v0.20.2](https://hyperledger.github.io/composer/latest/) Hyperledger Composer is an extensive, open development toolset and framework to make developing blockchain applications easier
* [Hyperledger Fabric v1.2](https://hyperledger-fabric.readthedocs.io) Hyperledger Fabric is a platform for distributed ledger solutions, underpinned by a modular architecture delivering high degrees of confidentiality, resiliency, flexibility and scalability.
* [IBM Blockchain Starter Plan](https://console.bluemix.net/catalog/services/blockchain) The IBM Blockchain Platform Starter Plan allows to build and try out blockchain network in an environment designed for development and testing

## Featured Technologies
* Laravel (https://laravel.com/) is a free, open-source PHP web framework, created by Taylor Otwell and intended for the development of web applications following the model–view–controller architectural pattern and based on Symfony.

# Manually deploy to IBM Cloud.

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

### Deploy Rest Server to Cloud Foundry Applications
 1. Register cloudant wallet service and get credentials
 2. Export cloudant wallet to NODE_CONFIG enviroment variable of cloud foundry app
 3. Push app to cloud foundry services
  ```
 bluemix cf push "${CF_APP}" --docker-image hyperledger/composer-rest-server:0.20.4 -c "npm install -g @ampretia/composer-wallet-cloudant; composer-rest-server -c admin@social-feedback -n never -w true" -i 1 -m 512M --no-start --no-manifest
```
4. Start rest server

`bluemix cf start "${CF_APP}"`

#  Running the Application (development mode)
Follow these steps to setup and run this code pattern. The steps are described in detail below.

## Prerequisite
- Operating Systems: Ubuntu Linux 14.04 / 16.04 LTS (both 64-bit), or Mac OS 10.12
- [Docker](https://www.docker.com/) (Version 17.03 or higher)
- [npm](https://www.npmjs.com/)  (v5.x)
- [Node](https://nodejs.org/en/) (version 8.9 or higher - note version 9 is not supported)
  * to install specific Node version you can use [nvm](https://davidwalsh.name/nvm)
- [Hyperledger Composer](https://hyperledger.github.io/composer/installing/development-tools.html)
  * to install composer cli
    `npm install -g composer-cli`
  * to install composer-rest-server
    `npm install -g composer-rest-server`
  * to install generator-hyperledger-composer
    `npm install -g generator-hyperledger-composer`

## Steps
1. [Clone the repo](#1-clone-the-repo)
2. [Setup Fabric](#2-setup-fabric)
3. [Generate the Business Network Archive](#3-generate-the-business-network-archive)
4. [Deploy to Fabric](#4-deploy-to-fabric)
5. [Run Application](#5-run-application)

## 1. Clone the repo

Clone the this locally. In a terminal, run:

```
git clone git@github.com:hamxn/social-feedback.git
cd social-feedback
```

## 2. Setup Fabric

These commands will kill and remove all running containers, and should remove all previously created Hyperledger Fabric chaincode images:

```none
docker kill $(docker ps -q)
docker rm $(docker ps -aq)
docker rmi $(docker images dev-* -q)
```

All the scripts will be in the directory `/fabric-dev-servers`.  Start fabric and create peer admin card:

```
cd fabric-dev-servers/
./downloadFabric.sh
./startFabric.sh
./createPeerAdminCard.sh
```

## 3. Generate the Business Network Archive

Next generate the Business Network Archive (BNA) file from the root directory:

```
cd bna
npm install
```

The `composer archive create` command in `package.json` has created a file called `social-feedback@0.1.1.bna`.


## 4. Deploy to Fabric

Now, we are ready to deploy the business network to Hyperledger Fabric. This requires the Hyperledger Composer chaincode to be installed on the peer,then the business network archive (.bna) must be sent to the peer, and a new participant, identity, and associated card must be created to be the network administrator. Finally, the network administrator business network card must be imported for use, and the network can then be pinged to check it is responding.

First, install the business network:

```
composer network install --card PeerAdmin@hlfv1 --archiveFile social-feedback@0.1.1.bna
```

Start the business network:

```
composer network start --networkName social-feedback --networkVersion 0.1.15 --networkAdmin admin --networkAdminEnrollSecret adminpw --card PeerAdmin@hlfv1 --file networkadmin.card
```

Import the network administrator identity as a usable business network card:

```
composer card import --file networkadmin.card
```

Check that the business network has been deployed successfully, run the following command to ping the network:
```
composer network ping --card admin@social-feedback
```

## 5. Run Application

To start the application:

```
 composer-rest-server -c admin@social-feedback -n never -w true -p3001
```

The REST server to communicate with network is available here:
`http://localhost:3000/explorer/`

