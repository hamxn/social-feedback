# Cổng tiếp nhận phản ánh người dân về ATTP
An toàn thực phẩm (ATTP) là vấn đề có tầm quan trọng đặc biệt, được tiếp cận với thực phẩm an toàn đang trở thành quyền cơ bản đối với mỗi con người. Thực phẩn toàn toàn đóng góp to lớn trong việc cải thiện sức khoẻ con người, chát lượng cuộc sống và chất lượng giống nòi. Ngộ độc thực phẩm và các bệnh do thực phẩm kém chất lượg gây ra không chỉ gây ảnh hưởng trực tiếp tới sức khoẻ và cuộc sống của mỗi người, mà còn gây thiệt hại lớn về kinh tế, là gánh nặng chi phí cho chăm sóc sức khoẻ. An toàn thực phẩm không chỉ ảnh hưởng trực tiếp, thường xuyên đến sức khoẻ mà còn liên quan chặt chẽ đến năng suất, hiệu quả phát triển kinh tế, thương mại, du lịch và an sinh xã hội. Đảm bảo an toàn thực phẩm góp phần quan trọng thúc đẩy phát triển kinh tế - xã hội, xoá đói giảm nghèo và hội nhập quốc tế.

Vệ sinh an toàn thực phẩm trên thế giới nói chung và của nước ta nói riêng đang tạo nhiều lo lắng cho người dân. Thực chất, nhiều sự kiện như việc tiếp tục sử dụng những hoá chất cấm dùng trong nuôi trồng, chế biến nông sản, thực phẩm; việc sản xuất một số sản phẩm kém chất lượng hoặc do quy trình chế biến hoặc do nhiễm độc từ môi trường,...đang gây ảnh hưởng xấu đến xuất khẩu và tiêu dùng. Các vụ ngộ độc thực phẩm tại một số bếp ăn tập thể, nhiều thông tin liên tục về tình hình ATVSTP ở một vài nước trên thế giới, cộng thêm dịch cúm gia cầm tái phát, bệnh heo tai xanh ở một số địa phương trong nước càng làm bùng lên sự lo âu của mọi chúng ta.

Công tác bảo đảm an toàn thực phẩm ở nước ta còn nhiều khó khăn, thách thức. Tình trạng ngộ độc thực. phẩm có xu hướng tăng và ảnh hưởng không nhỏ tới sức khoẻ cộng đồng. Sản xuất, kinh doanh thực phẩm ở nước ta cơ bản vẫn là nhỏ lẻ, quy mô hộ gia đình nên việc kiểm soát an toàn vệ sinh rất khó khăn. Mặc dù Việt Nam đã có những tiến bộ rõ rệt trong bảo đảm an toàn vệ sinh thực phẩm trong thời gian qua song công tác quản lý an toàn thực phẩm còn nhiều yếu kém, bất cập, hạn chế về nguồn lực và đầu tư kinh phí vã chưa đáp ứng được yêu cầu thực tiễn.

Thực chất đảm bảo VSATTP chỉ có thể giải quyết được tốt nếu có những biện pháp đồng bộ từ mọi người chúng ta, từ người quản lý, người sản xuất, đến người tiêu dùng điều phải đòng lòng thực hiện với mục tiêu giữ gìn sức khoẻ cho thế hệ chúng ta hôm nay và cả thế hệ con cháu chúng ta ngày mai.
                                                                                                      Sở Nông nghiệp & PTNT

Trên cơ sở tạo sự liên kết toàn dân để giải quyết vấn đề VSATTP, chúng tôi xây dựng một ứng dụng để có thể tiếp nhận kịp thời những phản ánh của người dân về vấn đề VSATTP, góp phần giải quyết những hạn chế về nguồn lực cũng như kinh phí giám sát.

Ở code này chúng tôi xây dựng một hệ thông nhận và phản hồi những phản ánh của người dân with Hyperledger Composer và demo thông qua Laravel web applicaiton. Ứng dụng sẽ thể hiện việc xử lý phản hồi phản ánh.

Blockchain ở đây để đảm bảo việc xử lý những phản ánh được công khai minh bạch, mà ai cũng có thể kiểm tra.

Có 3 dashboard trong hệ thống. 
- Người dân là người có vay trò đưa ra những phản ánh. 
- Sở Y Tế là đơn vị tiếp nhận, xử lý, và cập nhật trạng thái phản ánh
- Bộ Y Tế là bên thứ bên đóng vai trò giám sát.

# Architecture Flow
![Architecture Flow](https://github.com/hamxn/social-feedback/blob/master/flow.png)

1. Người dân có thể xem những thống kê về những phản ánh VSATTP trên dashboard của mình từ hệ thống blockchain.
2. Người dân đăng nhập vào hệ thống, viết phản ánh và submit phản ánh.
3. Sở Y Tế nhận phản ảnh ở dashboard của họ, họ sẽ xử lý phản ánh và cập nhận trạng thái vào hệ thống blockchain.
4. Bộ Y Tế có thể xem và track toàn bộ chi tiết và sự thay đổi trạng thái của phản ánh trên hệ thống blockchain.

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
