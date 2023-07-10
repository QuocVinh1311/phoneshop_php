-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 19, 2023 lúc 06:04 AM
-- Phiên bản máy phục vụ: 10.4.25-MariaDB
-- Phiên bản PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `phoneshop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `accessory`
--

CREATE TABLE `accessory` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(255) NOT NULL,
  `des` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(4) NOT NULL,
  `pic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_k` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `accessory`
--

INSERT INTO `accessory` (`id`, `name`, `quantity`, `des`, `price`, `pic`, `id_k`) VALUES
(1, 'Tai nghe chụp  tai 335', 3, 'Tai nghe đảm bảo êm tai', 127, 'tainghe1.jpg', 8),
(2, 'Sạc nhanh Iphone 20W', 0, 'Thông số: Output = 5V-3A & 9V-2A, chuẩn sạc nhanh Power Delivery – Có thể sạc nhanh cả cho các máy Android có Quick Charge 2.0/ 3.0. – Củ sạc nhanh 18w phù hợp với tất cả các dòng iPhone hiện nay nhưng được tối ưu nhất cho iPhone 8/ 8 Plus/ X/ Xs/ Xs Max ', 350000, 'saciphone.jpg', 9),
(3, 'Airpods 2', 0, 'Thiết kế màu trắng tinh tế, hiện đại cùng kích thước nhỏ gọn dễ mang theo mọi nơi. Tích hợp công nghệ chip H1 mới mẻ, cho tốc độ cho tốc độ kết nối giữa các thiết bị nhanh chóng, ổn định và khả năng đáp ứng độ trễ âm thanh tốt. Dễ dàng kích hoạt trợ lý ảo', 3500000, 'airpods.jpg', 8),
(4, 'Airpods pro 5', 0, 'Đặc điểm:    Âm thanh nổi chất lượng cao với tuổi thọ pin dài!!!   1. Phát các bài hát chuẩn xác, hỗ trợ nghe nhạc và thực hiện các cuộc gọi, tương thích với hệ điều hành Apple iOS, Android và các thiết bị Bluetooth khác,…   2. Hỗ trợ nhắc lại số điện tho', 6500000, 'airpodspro5.jpg', 8),
(5, 'Sac nhanh Samsung', 0, 'Giúp cải thiện thời gian sạc trên sam sung.', 500000, 'bo-sac-nhanh-samsung-a20-chinh-hang.jpg', 9),
(6, 'Đế sạc không dây xiaomi 6', 0, 'Đế sạc 20W WPC02ZM có khả năng tương thích hầu hết các thiết bị sạc không dây. Bên cạnh đó với dộ nhạy, đế sạc hỗ trợ khoảng cách truyền dưới 4mm, ', 350000, 'de-sac-khong-day-xiaomi__6_.jpg', 9);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `kind`
--

CREATE TABLE `kind` (
  `id_k` int(10) NOT NULL,
  `name_k` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `kind`
--

INSERT INTO `kind` (`id_k`, `name_k`) VALUES
(2, 'Android'),
(4, 'IOS 12'),
(5, 'IOS 16'),
(6, 'IOS'),
(7, 'Điện thoại'),
(8, 'Tai nghe'),
(9, 'Bộ sạc'),
(10, 'Loa');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` char(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `total` int(11) NOT NULL,
  `payment` varchar(100) NOT NULL,
  `status` text NOT NULL DEFAULT 'Chờ xử lí'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `full_name`, `address`, `phone_number`, `email`, `total`, `payment`, `status`) VALUES
(10, 'Nguyễn Quốc Vinh', 'Cần Thơ', '0772124823', 'vinhb1910022@gmail.com', 19930000, 'Thanh toán tiền mặt khi nhận hàng (COD)', 'Đã hủy'),
(11, 'Nguyễn Quốc Vinh', 'Cần Thơ', '0772124823', 'vinhb1910022@gmail.com', 32030000, 'Thanh toán tiền mặt khi nhận hàng (COD)', 'Đã hủy'),
(12, 'Nguyễn Quốc Vinh', 'Cần Thơ', '111111', 'vinh123@gmail.com', 19930000, 'Thanh toán tiền mặt khi nhận hàng (COD)', 'Đã hủy'),
(13, 'Nguyễn Quốc Vinh', 'Cần Thơ', '0772124823', 'vinhb1910022@gmail.com', 20530000, 'Thanh toán tiền mặt khi nhận hàng (COD)', 'Đã hủy');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_customer`
--

CREATE TABLE `order_customer` (
  `id_order` int(11) NOT NULL,
  `number_customer` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_customer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_order` datetime NOT NULL,
  `address_customer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_img` text NOT NULL,
  `price` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `thanhtien` int(11) NOT NULL,
  `id_orders` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `order_detail`
--

INSERT INTO `order_detail` (`id`, `product_name`, `product_img`, `price`, `amount`, `thanhtien`, `id_orders`) VALUES
(0, 'Iphone 14', 'ip14_den.jpg', 32000000, 3, 96000000, 0),
(0, 'Iphone 14', 'ip14_den.jpg', 32000000, 3, 96000000, 0),
(0, 'Iphone 14', 'ip14_den.jpg', 32000000, 3, 96000000, 0),
(0, 'Iphone 12 Pro Max', 'ip12pxanh128g.jpg', 19900000, 2, 39800000, 0),
(0, 'Iphone 14', 'ip14_den.jpg', 32000000, 2, 64000000, 0),
(0, 'Iphone 12 Pro Max', 'ip12pxanh128g.jpg', 19900000, 12, 238800000, 0),
(0, 'Iphone 13 Pro Max', 'ip_13pm_xanh.jpg', 22900000, 1, 22900000, 0),
(0, 'Iphone 12 Pro Max', 'ip12pxanh128g.jpg', 19900000, 12, 238800000, 0),
(0, 'Iphone 13 Pro Max', 'ip_13pm_xanh.jpg', 22900000, 1, 22900000, 0),
(0, 'Iphone 12 Pro Max', 'ip12pxanh128g.jpg', 19900000, 1, 19900000, 0),
(0, 'Iphone 12 Pro Max', 'ip12pxanh128g.jpg', 19900000, 1, 19900000, 10),
(0, 'Iphone 14', 'ip14_den.jpg', 32000000, 1, 32000000, 11),
(0, 'Iphone 12 Pro Max', 'ip12pxanh128g.jpg', 19900000, 1, 19900000, 12),
(0, 'Oppo Reno 8 Series', 'oppo_reno_8_series_gold.jpg', 20500000, 1, 20500000, 13);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id_p` int(10) NOT NULL,
  `name_p` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `pic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `des` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ram` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rom` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hdh` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pin` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `screen` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_k` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id_p`, `name_p`, `quantity`, `pic`, `price`, `des`, `color`, `ram`, `rom`, `hdh`, `pin`, `screen`, `id_k`) VALUES
(8, 'Samsung Galaxy Z Flip4 5G', 7, 'samsunggalaxy_zflip5g_gold.jpg', 18900000, 'Theo như hãng công bố thì phiên bản điện thoại Galaxy Z này có thể gập lên đến 200.000 lần liên tục trong phòng thí nghiệm. Nếu trung bình một ngày bạn gập, mở máy khoảng 50 lần thì mất khoảng 10 năm thì mới có thể đạt đến số lần gập này.', 'Gold', '8', '256', 'Android', '3700', 'Gold', 7),
(9, 'Xiaomi Redmi Note 11', 10, 'xiaome_redme_note11_den.jpg', 4800000, 'Redmi Note 11 cấu hình tốt với con chip Snapdragon 680Màn hình: Kích thước 6.43 inch, tấm nền AMOLED, độ phân giải Full HD+, tần số quét 90 Hz. Hệ điều hành: Android 11 (giao diện MIUI 13). Camera sau: Chính 50 MP, góc siêu rộng 8 MP, camera macro 2 MP, camera đo chiều sâu 2 MP. Camera trước: 13 MP.', 'Xám', '8', '128', 'Android', '5000', 'Xám', 7),
(10, 'Oppo Reno 8 Series', 12, 'oppo_reno_8_series_gold.jpg', 20500000, 'Redmi Note 11 cấu hình tốt với con chip Snapdragon 680Màn hình: Kích thước 6.43 inch, tấm nền AMOLED, độ phân giải Full HD+, tần số quét 90 Hz. Hệ điều hành: Android 11 (giao diện MIUI 13). Camera sau: Chính 50 MP, góc siêu rộng 8 MP, camera macro 2 MP, camera đo chiều sâu 2 MP. Camera trước: 13 MP.', 'Gold', '8', '256', 'Android', '4500', 'Gold', 7),
(11, 'Samsung Galaxy A23', 12, 'samsunggalaxya23_den.jpg', 44200000, 'Trải nghiệm hình ảnh sắc nét với màn hình tràn viền Infinity-V lớn 6.6” FHD+\r\nTần suất quét màn hình 90Hz cho trải nghiệm xem phim chơi game mượt mà\r\n4 camera 50MP, 5MP, 2MP, 2MP chụp ảnh sắc nét, lưu giữ khoảnh khắc đáng nhớ\r\nPin điện thoại 5000mAh cho trải nghiệm lên đến 2 ngày cùng sạc siêu nhanh 25W\r\nĐáp ứng nhu cầu học tập, làm việc, giải trí nhờ vi xử lý 8 nhân Snapdragon 680\r\nÂm thanh vòm Dolby Atmos cho trải nghiệm âm thanh chân thật, sống động', 'Đen', '6', '128', 'Android', '5000', 'Đen', 7),
(12, 'Oppo Reno 8 T 5G', 0, 'oppo_reno8_den.jpg', 10900000, 'Thiết kế thời thượng - Tràn viền, mỏng nhẹ đặc biệt phù hợp với các bạn trẻ, yêu khám phá xu hướng mới\r\nGiải trí ấn tượng - Màn hình 1 tỉ màu, tần số quét 120Hz ấn tượng\r\nChụp ảnh chân dung chuyên nghiệp - Camera 108MP sắc nét đi kèm thuật toán AI\r\nPin dùng cả ngày - Viên pin lớn 4800 mAh, sạc siêu nhanh đến 67 W', 'Đen', '8', '128', 'Android', '5000', 'Đen', 7),
(13, 'Samsung Galaxy S23', 0, 'samsunggalaxy_s23_xanh.jpg', 39900000, 'Samsung Galaxy S23 5G 128GB chắc hẳn không còn là cái tên quá xa lạ đối với các tín độ công nghệ hiện nay, được xem là một trong những gương mặt chủ chốt đến từ nhà Samsung với cấu hình mạnh mẽ bậc nhất, camera trứ danh hàng đầu cùng lối hoàn thiện vô cùng sang trọng và hiện đại.\r\nSở hữu lối thiết kế sang trọng\r\nỞ phiên bản năm nay, mình rất vui khi biết được rằng Galaxy S23 vẫn giữ nguyên kiểu dáng quen thuộc từ thế hệ trước, nó được xem là một biểu tượng của dòng điện thoại Samsung Galaxy dòng S khi mang trong mình một đặc trưng riêng biệt và đầy đẳng cấp.\r\n\r\nMặt lưng kính của máy vẫn được bao phủ bởi bộ khung kim loại và bo tròn ở các góc, cùng với cách tạo hình phẳng trên các mặt. Điều này làm cho điện thoại trở nên sang trọng và hiện đại, cực kỳ phù hợp cho những bạn đang muốn có một chiếc máy bắt trend về ngoại hình ở thời điểm hiện tại.\r\n\r\nỞ lần này Samsung đã thực hiện một số thay đổi nhỏ ở phần camera để tạo sự khác biệt so với thế hệ trước. Không còn các ống kính nằm chung cụm như trước đây nữa, thay vào đó là một cách sắp xếp riêng lẻ độc đáo, nhờ đó mà mình có thể dễ dàng nhận biết được đâu là sản phẩm thuộc thế hệ tiền nhiệm và đâu mới là mẫu Galaxy S23.', 'Xanh', '8', '128', 'Android', '3900', 'Xanh', 7),
(14, 'Vivo Y35', 0, 'vivo-y35_den.jpg\r\n', 4800000, 'Vivo Y35 có kích thước màn hình 6.58 inch đi cùng là tấm nền IPS LCD, độ phân giải Full HD+ với những thông số trên chất lượng hình ảnh hiển thị có chi tiết tốt, góc nhìn rộng và màu sắc trung thực.\r\nHãng đã làm những mẫu điện thoại Vivo Y có độ sáng màn hình khá cao giúp bạn quan sát tốt khi sử dụng ngoài trời nắng. Vivo Y35 cũng không ngoại lệ khi được trang bị độ sáng 550 nits mang đến chất lượng hiển thị tốt khi ngoài trời.\r\n\r\nKhông dừng lại ở đó lần ra mắt này Vivo đã mang Hi-Res Audio lên trên Y35, giờ đây bạn sẽ có những buổi tiệc âm nhạc tuyệt vời ngay trên dế yêu của mình.\r\nVivo Y35 mang trong mình con chip Snapdragon 680, đây là CPU quốc dân của những mẫu điện thoại Android, máy đáp ứng tốt các nhu cầu hiện nay của người dùng từ đọc báo, lướt web đến chơi những tựa game đang hot trên thị trường.\r\n\r\n\r\n', 'Đen', '6', '64', 'Android', '3200', 'Đen', 7),
(15, 'Samsung Galaxy A53', 10, 'samsunggalaxy_a53_xanhduong.jpg', 20500000, 'Máy trang bị tấm nền Super AMOLED với kích thước màn hình lên đến 6.5 inch mang đến hình ảnh đầy màu sắc, độ tương phản cao, tối ưu năng lượng tiêu hao và không gian hiển thị đầy đủ, bao quát.\r\n\r\nRa mắt 4 phiên bản màu sắc nhằm đa dạng tùy chọn đến với khách hàng, cùng với đó là tone màu pastel mang đến vẻ trẻ trung và tươi mới, phù hợp với các bạn trẻ năng động, cá tính hay những ai yêu thích các tone màu dịu êm.\r\nGalaxy A53 5G sử dụng lối thiết kế phẳng, đem lại cái nhìn rất hợp xu hướng và thời thượng. Các cạnh được bo cong mềm mại mang đến cho mình cảm giác cầm nắm rất thoải mái, sử dụng lâu dài mà không cảm thấy quá cấn tay.\r\n\r\nMáy được thiết kế nguyên khối từ nhựa cao cấp nhằm tối ưu khối lượng và mặt lưng gia công nhám giúp hạn chế các vết bám vân tay và mồ hôi khá tốt, điều này thực sự rất hữu ích đối với những ai thường ra mồ hôi tay như cá nhân mình.\r\nTrang bị ở phần mặt lưng là cụm camera được thiết kế \"hiệu ứng nổi 3D\" rất nổi bật với 4 camera bên trong, giúp bạn có được những bức ảnh sắc nét hơn nhờ tích hợp nhiều tính năng mới mẻ và bộ thông số ấn tượng như: Camera chính 64 MP, camera góc siêu rộng 12 MP và hai camera phụ 5 MP.\r\n\r\nCác bức ảnh thu được có độ chi tiết tốt, màu sắc được tái tạo chân thực nhờ trang bị camera chính có độ phân giải cao, với khả năng zoom tối đa 10x giúp mình phóng to vật thể một cách nhanh chóng hay bắt lại những khoảnh khắc xung quanh được bao quát và đầy đủ khi kích hoạt tính năng chụp ảnh góc siêu rộng.\r\n\r\n', 'Xanh dương', '4', '64', 'Android', '3240', 'Xanh dương', 7),
(16, 'Realme C30', 0, 'realme_c30_den.jpg', 3200000, '', 'Đen', '6', '128', 'Android', '3240', '6.6', 7),
(17, 'Oppo A95', 0, 'oppo_a95_den.jpg', 5900000, 'OPPO A95 có thiết kế trẻ trung hiện đại với công nghệ phủ màu độc quyền OPPO. Nó mềm mại mượt mà, chống mài mòn và chống bám vân tay một cách hiệu quả.\r\nĐồng thời mặt lưng máy còn gây ấn tượng lớn cho người dùng với hiệu ứng chuyển màu bắt mắt khi thay đổi góc nhìn (ở phiên bản màu bạc), điều này giúp máy trở nên bóng bẩy thu hút ngay từ ánh nhìn đầu tiên.\r\nOPPO A95 sẽ có 2 phiên bản màu sắc Glowing Rainbow Silver (Bạc) và Glowing Starry Black (Đen) cho người dùng thỏa thích lựa chọn theo sở thích của mình.\r\n\r\nTổng thể điện thoại rất sang trọng, cảm giác cầm nắm thoải mái khi có độ mỏng 7.95 mm và khối lượng 175 g kết hợp với phần khung viền được làm cong 2.5D đem đến trải nghiệm sử dụng vô cùng thích thú.\r\n\r\nPhía trước OPPO A95 là màn hình \"đục lỗ\" theo xu hướng hiện tại nằm ở vị trí phía trên cùng bên trái như OPPO Reno6 với kích thước 6.43 inch và tỉ lệ hiển thị lên 90.2% rộng lớn để bạn có thể tận hưởng các bộ phim yêu thích hay chiến game cực đã.\r\nHơn nữa tấm nền AMOLED cao cấp với độ phân giải Full HD+ phủ 92% gam màu DCI-P3 và 100% sRGB, OPPO A95 mang tới chất lượng hình ảnh chi tiết, sắc nét, màu sắc sống động, giúp bạn chìm đắm trong không gian giải trí ấn tượng. \r\n\r\nNgoài ra, máy còn hỗ trợ tính năng bảo vệ mắt thông minh AI có khả năng tự động điều chỉnh theo các môi trường ánh sáng khác nhau, giúp chăm sóc và bảo vệ đôi mắt của bạn mọi lúc mọi nơi, kể cả ngày hay đêm.\r\n\r\n', 'Đen', '8', '256', 'Android', '5000', 'Đen', 7),
(20, 'iphone 14', 10, 'ip14_den.jpg', 20300000, 'Được hoàn thiện với những vật liệu cao cấp khi mặt lưng làm từ kính cùng bộ khung nhôm chắc chắn, điều này làm cho chiếc máy của bạn trở nên sang trọng và đẳng cấp hơn.\r\nMàn hình mang đến cái nhìn trong trẻo và màu sắc bắt mắt giúp mọi tác vụ chơi game hay xem phim của bạn trở nên tuyệt vời hơn rất nhiều.\r\n\r\n', 'Đen', '4', '1024', 'IOS', '3000', '6.1', 7),
(21, 'Iphone 11', 10, 'iphone-11-den.jpg', 9900000, 'Nói về nâng cấp thì camera chính là điểm có nhiều cải tiến nhất trên thế hệ iPhone mới.\r\n\r\nNếu như trước đây iPhone Xr chỉ có một camera thì nay với iPhone 11 chúng ta sẽ có tới hai camera ở mặt sau.\r\n\r\nNgoài camera chính vẫn có độ phân giải 12 MP thì chúng ta sẽ có thêm một camera góc siêu rộng và cũng với độ phân giải tương tự.Theo Apple thì việc chuyển đổi qua lại giữa hai ống kính thì sẽ không làm thay đổi màu sắc của bức ảnh.Đây là một điều được xem là bước ngoặt bởi những chiếc smartphone Android có nhiều camera hiện nay sẽ thường bị sai lệch về màu sắc khi chuyển đổi qua lại giữa các ống kính gây cảm giác khá khó chịu cho người dùng.\r\n\r\nBên cạnh đó với iPhone 11 thì đây sẽ là lần đầu tiên Apple trang bị khả năng chụp đêm lên chiếc iPhone của mình.Theo trải nghiệm thì tính năng này hoạt động rất hiệu quả đặc biệt trong những môi trường cực kỳ thiếu sáng.Kích hoạt chế độ chụp đêm sẽ do iPhone tự quyết định việc của bạn chỉ cần đưa máy lên và chụp, rất đơn giản.Năm nay Apple cũng đã nâng cấp độ phân giải camera trước nên 12 MP thay vì 7 MP như thế hệ trước đó.\r\n\r\nCamera trước cũng có một tính năng thông minh, khi bạn xoay ngang điện thoại nó sẽ tự kích hoạt chế độ selfie góc rộng để bạn có thể chụp với nhiều người hơn.', 'Đen', '4', '256', 'IOS', '3240', '6.1 ', 7),
(22, 'iphone 14', 10, 'ip14_den.jpg', 20300000, 'Được hoàn thiện với những vật liệu cao cấp khi mặt lưng làm từ kính cùng bộ khung nhôm chắc chắn, điều này làm cho chiếc máy của bạn trở nên sang trọng và đẳng cấp hơn.\r\nMàn hình mang đến cái nhìn trong trẻo và màu sắc bắt mắt giúp mọi tác vụ chơi game hay xem phim của bạn trở nên tuyệt vời hơn rất nhiều.\r\n\r\n', 'Đen', '4', '1024', 'IOS', '3000', '6.1', 7),
(23, 'Iphone 13 Pro', 10, 'ip_13_p_xanh.jpg', 1991000, 'iPhone 13 Pro không có nhiều sự thay đổi về thiết kế, khi máy vẫn sở hữu kiểu dáng tương tự như điện thoại iPhone 12 Pro với các cạnh viền vuông vắn và hai mặt kính cường lực cao cấp. Sở hữu 5 phiên bản màu gồm xanh dương, bạc, vàng đồng, xám và xanh lá cho bạn tùy chọn theo sở thích của mình. \r\n\r\nMáy đạt tiêu chuẩn kháng nước và bụi IP68 có khả năng chống lại một số hạt bụi, và được bảo vệ khi rơi xuống nước ở độ sâu đến 6 mét trong 30 phút theo chuẩn IEC 60529, thoải mái nhắn tin khi lỡ ra ngoài gặp mưa, chụp ảnh tự tin khi đi hồ bơi, bãi biển,.\r\n\r\nĐiện thoại iPhone 13 Pro vẫn được trang bị màn hình kích thước 6.1 inch, với phần tai thỏ được làm nhỏ hơn giúp hiển thị thêm nhiều thông tin cũng như tăng cường cảm giác trải nghiệm. Bề mặt có lớp phủ oleophobic chống bám vân tay, giữ cho màn hình luôn được sạch mới. \r\n\r\niPhone 13 Pro đã được nâng cấp lên tần số quét 120 Hz, với ProMotion có thể làm mới từ 10 đến 120 khung hình/giây. Với tần số quét cao, mọi thao tác chuyển cảnh khi lướt ngón tay trên màn hình trở nên mượt mà hơn đồng thời hiệu ứng thị giác khi chúng ta dùng điện thoại chơi game hoặc xem video cũng cực kỳ mãn nhãn.\r\n\r\n', 'xanh', '6', '1024', 'IOS', '3460', '6.5', 7);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` char(10) NOT NULL,
  `pass_word` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `phone_number`, `pass_word`) VALUES
(1, 'Admin', 'admin@gmail.com', '1111111111', '$2y$10$eLQHlWM1G7Uad//mae0d/OHBHz7XcSQGY5RM1ql2r92e3SG.a56G2'),
(2, 'Nguyễn Quốc Vinh', 'vinhb1910022@gmail.com', '0772124823', '$2y$10$60HD5Nktpa8CSj5E3XJvkOefhZ7BnK7CNMgxA9nAIYbE0jPtWsFtO'),
(3, 'Nguyễn Quốc Vinh', 'vinh123@gmail.com', '111111', '$2y$10$JnSI4GUVooEdzbM5/DH7GOK6rLreZMjPEa9Fez/YEKImt62gfmYay');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `accessory`
--
ALTER TABLE `accessory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_k` (`id_k`);

--
-- Chỉ mục cho bảng `kind`
--
ALTER TABLE `kind`
  ADD PRIMARY KEY (`id_k`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order_customer`
--
ALTER TABLE `order_customer`
  ADD PRIMARY KEY (`id_order`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_p`),
  ADD KEY `id_k` (`id_k`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `accessory`
--
ALTER TABLE `accessory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `kind`
--
ALTER TABLE `kind`
  MODIFY `id_k` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `order_customer`
--
ALTER TABLE `order_customer`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id_p` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `accessory`
--
ALTER TABLE `accessory`
  ADD CONSTRAINT `accessory_ibfk_1` FOREIGN KEY (`id_k`) REFERENCES `kind` (`id_k`);

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`id_k`) REFERENCES `kind` (`id_k`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
