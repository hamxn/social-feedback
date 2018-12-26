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
cd rest-server
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

