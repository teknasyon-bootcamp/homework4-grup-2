-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2021 at 09:38 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `group2`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `name`) VALUES
(1, 'Teknoloji'),
(2, 'Kültür Sanat'),
(3, 'Bilim'),
(4, 'Yaşam');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `content` text COLLATE utf8_turkish_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `post_image` text COLLATE utf8_turkish_ci DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `author` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `source` text COLLATE utf8_turkish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `title`, `content`, `category_id`, `post_image`, `date`, `author`, `source`) VALUES
(1, 'KÜRESELLEŞEN DÜNYADA TEKNOLOJİ EĞİTİMİ\r\n', 'Bu çalışmada, küreselleşme kapsamında teknoloji eğitiminde son zamanlardaki eğilimlerin \ntanıtılması amaçlanmaktadır. Teknoloji Eğitimi konusunda yeterli sayıda Türkçe kaynak \nbulunmaması, bu çalışmanın bir derleme şeklinde hazırlanmasını zorunlu kılmıştır. \nTeknolojik gelişmeler tarafından yönlendirilen küreselleşme sürecinin bir sonucu olarak; \nsınırlar arası ekonomik, politik ve sosyo-kültürel ilişkilerin kurulması ve devam \nettirilmesinde coğrafi mesafelerin daha az önemli hale geldiği bir dünyada yaşamaktayız. \nMallar, hizmetler, sermaye, insan ve bilginin dolaşımının artmasıyla; modern dünyanın \nkarşılıklı bağımlılığının ve karşılıklı bağlanmışlığının gelişmesinde, teknoloji anahtar bir \nrol üstlenmektedir. Süregelen bilimsel-teknik devrim göz önüne alındığında, eğitimin \nküresel kavramları ile istenilen miktarda bilgi ve becerinin aktarılması 21. Yüzyılın başında \ndaha da önemli bir hale gelmiştir. Eğitim seviyesi, öğretim stratejileri ve sınıflarda yeni \nelektronik ortamların yaratıcı bir şekilde kullanılmasından etkilenmektedir. <br/>\nBu teknolojik dünyada insanların, modern teknolojinin kavramları ve işlerini anlamaları ve \nkendilerini rahat hissetmeleri özellikle önemlidir. Bu ve diğer nedenlerden dolayı teknoloji \nile ilgili öğretimin değeri ve önemi geniş kabul görmüştür. Küresel ölçekte teknoloji eğitimi \nprogramlarının çoğu; analitik düşünme, yaratıcılık, problem çözme, bir takım halinde \nçalışma, kişisel sorumluluk, inisiyatif ve merak etme gibi yeteneklerin geliştirilmesini \nkapsamaktadır. Bu makalede; Amerika Birleşik Devletleri, Avrupa Birliği, Doğu ve Güney \nDoğu Asya, Avustralya ve Yeni Zelanda’daki teknoloji eğitimi yaklaşımları\nincelenmektedir. Son olarak, dünyadaki teknolojik gelişimi yakalamak amacıyla, ulusal \nteknoloji eğitimi programlarının sürekli modernizasyonu kavramı ile müfredat programının \niçeriğinin yenileştirilmesi konuları ele alınmaktadır.', 1, 'img/posts/teknolojiEgitim.jpg', '2021-09-08 10:58:53', 'Hasan', 'https://dergipark.org.tr/en/download/article-file/296526'),
(2, 'DEĞİŞEN DÜNYADA KÜLTÜR SANAT VE BİLİM İLİŞKİSİ', 'İnsan, ‘bilgisi üstüne katlanarak bilen beşer’ demektir. Filosof ‘bilgi’yi ve onun zihindeki yapı taşı durumundaki ‘kavram’ı kendine konu edinen kişi olması bakımından, sistemleştirilmiş bilgiler bütünlüğü biçiminde özetleyebileceğimiz ‘bilim’in ‘bilgin’idir. Bu durumda ‘bilgi’ üreten bilim, onun ürettiği ‘bilgiler’ üstünde düşünen de felsefedir. Felsefe, bilimin ürettiği bilgiler üstüne dönüp tasarılar oluşturmasaydı bilim iş göremez duruma düşerdi. İkisinin bir arada temsil ettiği kudret, olağanüstüdür. Bu kitap, din ile görünürler dünyası arasında kalan kesimde akıl yürütme kılavuzluğunda bilgi üretip, üretileni sınayan kurumlaşmış felsefe-bilimin ortaya çıkışı ile işleyişini tarih arka planı çerçevesinde belirleyip açıklamaya çalışmaktadır.', 2, 'img/posts/sanatBilimIliskisi.jpg', '2021-09-08 11:03:59', 'Esra', 'https://dergipark.org.tr/en/pub/buyasambid/issue/29824/320863'),
(3, 'FELSEFE - BİLİM NEDİR?', 'İnsan, ‘bilgisi üstüne katlanarak bilen beşer’ demektir. Filosof ‘bilgi’yi ve onun zihindeki yapı taşı durumundaki ‘kavram’ı kendine konu edinen kişi olması bakımından, sistemleştirilmiş bilgiler bütünlüğü biçiminde özetleyebileceğimiz ‘bilim’in ‘bilgin’idir. Bu durumda ‘bilgi’ üreten bilim, onun ürettiği ‘bilgiler’ üstünde düşünen de felsefedir. Felsefe, bilimin ürettiği bilgiler üstüne dönüp tasarılar oluşturmasaydı bilim iş göremez duruma düşerdi. İkisinin bir arada temsil ettiği kudret, olağanüstüdür. Bu kitap, din ile görünürler dünyası arasında kalan kesimde akıl yürütme kılavuzluğunda bilgi üretip, üretileni sınayan kurumlaşmış felsefe-bilimin ortaya çıkışı ile işleyişini tarih arka planı çerçevesinde belirleyip açıklamaya çalışmaktadır.', 3, 'img/posts/felsefeBilim.jpg', '2021-09-08 11:11:43', 'Kadir', 'http://193.140.60.133/xmlui/handle/20.500.12154/1131'),
(4, 'YAŞAM KALİTESİ2', 'Sağlık araştırmaları alanında “Yaşam Kalitesi”nin değerlendirilmesine son yıllarda yoğun bir ilgi duyulmaktadır. Onkoloji çalışmalarında ise yaklaşık elli yıldan bu yana kullanılan Karnofsky ölçeği bu alandaki ilk ölçeklerdendir. Güncel anlamda ise uzun süredir alt üriner sistem semptomlarında kullandığımız uluslararası prostat semptom skoru ile hastaların yaşam kaliteleri rutin olarak saptanmaktadır. Günümüzde yaşam kalitesi kavramına bir başka bakış kazandırılarak kaynağa yönelik çalışmalarla birlikte çeşitli hastalıklar için özel ölçekler geliştirilmeye çalışılmaktadır. Artık “Yaşam Kalitesi”nin ölçülmesi, sağlık çalışmalarında ve sağlık politikalarının sonuçlarının değerlendirilmesi ve yeni politikalar üretilmesinde rutin olarak kullanılmaktadır. Bu makalede üroonkoloji alanına odaklanan meslekdaşlarımızın “Yaşam Kalitesi” hakkında bilgi birikimlerinin desteklenmesi ve araştırmaların gerek ulusal gerek uluslararası dergilerde yer bulması için dikkat edilmesi gereken konuların sunulması amaçlanmaktadır.<br/>(Yaşam Kalitesi kavramsal olarak yeni bir bakış getirdiği gibi doğal olarak beraberinde yeni bir terminoloji de getirmektedir. Bu nedenle makalede üroloji literatüründe çok sık karşılaşmadığımız bazı yeni terimlerin yanında ilgili literatürü incelerken kolaylık sağlamak amacıyla ingilizce karşılıkları da verildi.', 4, 'img/posts/yasamKalitesi.jpg', '2021-09-08 11:14:40', 'Kaan', 'http://cms.galenos.com.tr/Uploads/Article_8598/25-29.pdf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
