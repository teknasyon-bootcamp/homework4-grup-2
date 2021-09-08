-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 08 Eyl 2021, 08:36:47
-- Sunucu sürümü: 8.0.17
-- PHP Sürümü: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `group2`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `author`
--

CREATE TABLE `author` (
  `author_id` int(11) NOT NULL,
  `first_name` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `author`
--

INSERT INTO `author` (`author_id`, `first_name`, `last_name`) VALUES
(1, 'Ahmet', 'ŞENEL'),
(2, 'Benal', 'DİKMEN'),
(3, 'Şaban Teoman', 'DURALI'),
(4, 'Talha', 'MÜEZZİNOĞLU');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `category`
--

INSERT INTO `category` (`category_id`, `name`) VALUES
(1, 'Teknoloji'),
(2, 'Kültür Sanat'),
(3, 'Bilim'),
(4, 'Yaşam');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `content` text COLLATE utf8_turkish_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `image` text CHARACTER SET utf8 COLLATE utf8_turkish_ci,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author_id` int(11) NOT NULL,
  `kaynak` text CHARACTER SET utf8 COLLATE utf8_turkish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `post`
--

INSERT INTO `post` (`post_id`, `title`, `content`, `category_id`, `image`, `date`, `author_id`, `kaynak`) VALUES
(1, 'KÜRESELLEŞEN DÜNYADA TEKNOLOJİ EĞİTİMİ\r\n', 'Bu çalışmada, küreselleşme kapsamında teknoloji eğitiminde son zamanlardaki eğilimlerin \ntanıtılması amaçlanmaktadır. Teknoloji Eğitimi konusunda yeterli sayıda Türkçe kaynak \nbulunmaması, bu çalışmanın bir derleme şeklinde hazırlanmasını zorunlu kılmıştır. \nTeknolojik gelişmeler tarafından yönlendirilen küreselleşme sürecinin bir sonucu olarak; \nsınırlar arası ekonomik, politik ve sosyo-kültürel ilişkilerin kurulması ve devam \nettirilmesinde coğrafi mesafelerin daha az önemli hale geldiği bir dünyada yaşamaktayız. \nMallar, hizmetler, sermaye, insan ve bilginin dolaşımının artmasıyla; modern dünyanın \nkarşılıklı bağımlılığının ve karşılıklı bağlanmışlığının gelişmesinde, teknoloji anahtar bir \nrol üstlenmektedir. Süregelen bilimsel-teknik devrim göz önüne alındığında, eğitimin \nküresel kavramları ile istenilen miktarda bilgi ve becerinin aktarılması 21. Yüzyılın başında \ndaha da önemli bir hale gelmiştir. Eğitim seviyesi, öğretim stratejileri ve sınıflarda yeni \nelektronik ortamların yaratıcı bir şekilde kullanılmasından etkilenmektedir. <br/>\nBu teknolojik dünyada insanların, modern teknolojinin kavramları ve işlerini anlamaları ve \nkendilerini rahat hissetmeleri özellikle önemlidir. Bu ve diğer nedenlerden dolayı teknoloji \nile ilgili öğretimin değeri ve önemi geniş kabul görmüştür. Küresel ölçekte teknoloji eğitimi \nprogramlarının çoğu; analitik düşünme, yaratıcılık, problem çözme, bir takım halinde \nçalışma, kişisel sorumluluk, inisiyatif ve merak etme gibi yeteneklerin geliştirilmesini \nkapsamaktadır. Bu makalede; Amerika Birleşik Devletleri, Avrupa Birliği, Doğu ve Güney \nDoğu Asya, Avustralya ve Yeni Zelanda’daki teknoloji eğitimi yaklaşımları\nincelenmektedir. Son olarak, dünyadaki teknolojik gelişimi yakalamak amacıyla, ulusal \nteknoloji eğitimi programlarının sürekli modernizasyonu kavramı ile müfredat programının \niçeriğinin yenileştirilmesi konuları ele alınmaktadır.', 1, 'img/posts/teknolojiEgitim.jpg', '2021-09-08 10:58:53', 1, 'https://dergipark.org.tr/en/download/article-file/296526'),
(2, 'DEĞİŞEN DÜNYADA KÜLTÜR SANAT VE BİLİM İLİŞKİSİ\r\n', 'Kültürlerin iki unsuru olan sanat ve bilim, aralarındaki birçok zıtlığa karşın benzerliklere de sahiptirler ve birbirleriyle etkileşim içindedirler. Sanatın tanımı çağlara, toplumlara ve sanat alanına göre değişiklikler göstermektedir. Günümüzde yaygın olarak, görsel sanatlar için kullanılan sanat kavramı, ilkçağda bilimlerle aynı sınıflandırmalara tabi tutularak insanın bütün diğer uğraşlarından doğan yaratıcı gücü için kullanılmıştır. Bu bağlamda, teknoloji sözcüğü de, sözlük anlamı açısından sanat kavramıyla ortak bir içeriği paylaşmaktadırlar. En genel anlamıyla bilim, belli bir alanda ya da belli bir konuda ortaya konulmuş dizgesel bilgiler toplamı olarak tanımlanabilir. Sanat, tarih boyunca birçok bilim dalından etkilenmiş, bilim ve teknolojideki gelişmeler sanat dallarının yeni biçimler kazanmasına ve yeni sanat dallarının ortaya çıkmasına yol açmıştır. Ancak modern çağda, estetiğin bir bilim dalı olarak tanımlanmasıyla sanatın kendisi bir bilim dalı haline gelmiştir. Çağımızda bilim ve teknolojideki gelişmelerin sonucunda, küreselleşmenin de etkisiyle çağdaş biçimlerin ve tekniklerin çeşitliliği artmakta, yeni araçlar ve yollar, geleneksel sanat dallarıyla birlikte yer almaktadır.', 2, 'img/posts/sanatBilimIliskisi.jpg', '2021-09-08 11:03:59', 2, 'https://dergipark.org.tr/en/pub/buyasambid/issue/29824/320863'),
(3, 'FELSEFE - BİLİM NEDİR?', 'İnsan, ‘bilgisi üstüne katlanarak bilen beşer’ demektir. Filosof ‘bilgi’yi ve onun zihindeki yapı taşı durumundaki ‘kavram’ı kendine konu edinen kişi olması bakımından, sistemleştirilmiş bilgiler bütünlüğü biçiminde özetleyebileceğimiz ‘bilim’in ‘bilgin’idir. Bu durumda ‘bilgi’ üreten bilim, onun ürettiği ‘bilgiler’ üstünde düşünen de felsefedir. Felsefe, bilimin ürettiği bilgiler üstüne dönüp tasarılar oluşturmasaydı bilim iş göremez duruma düşerdi. İkisinin bir arada temsil ettiği kudret, olağanüstüdür. Bu kitap, din ile görünürler dünyası arasında kalan kesimde akıl yürütme kılavuzluğunda bilgi üretip, üretileni sınayan kurumlaşmış felsefe-bilimin ortaya çıkışı ile işleyişini tarih arka planı çerçevesinde belirleyip açıklamaya çalışmaktadır.', 3, 'img/posts/felsefeBilim.jpg', '2021-09-08 11:11:43', 3, 'http://193.140.60.133/xmlui/handle/20.500.12154/1131'),
(4, 'YAŞAM KALİTESİ', 'Sağlık araştırmaları alanında “Yaşam Kalitesi”nin değerlendirmesine son yıllarda yoğun bir ilgi duyulmaktadır. Onkoloji \nçalışmalarında ise yaklaşık elli yıldan bu yana kullanılan Karnofsky ölçeği bu alandaki ilk ölçeklerdendir. Güncel anlamda \nise uzun süredir alt üriner sistem semptomlarında kullandığımız uluslararası prostat semptom skoru ile hastaların yaşam kaliteleri rutin olarak \nsaptanmaktadır. Günümüzde yaşam kalitesi kavramına bir başka bakış \nkazandırılarak kaynağa yönelik çalışmalarla birlikte çeşitli hastalıklar \niçin özel ölçekler geliştirilmeye çalışılmaktadır. Artık “Yaşam Kalitesi”nin \nölçülmesi, sağlık çalışmalarında ve sağlık politikalarının sonuçlarının \ndeğerlendirilmesi ve yeni politikalar üretilmesinde rutin olarak kullanılmaktadır. Bu makalede üroonkoloji alanına odaklanan meslekdaşlarımızın “Yaşam Kalitesi” hakkında bilgi birikimlerinin desteklenmesi \nve araştırmaların gerek ulusal gerek uluslararası dergilerde yer bulması \niçin dikkat edilmesi gereken konuların sunulması amaçlanmaktadır.<br/>\n(Yaşam Kalitesi kavramsal olarak yeni bir bakış getirdiği gibi doğal \nolarak beraberinde yeni bir terminoloji de getirmektedir. Bu nedenle \nmakalede üroloji literatüründe çok sık karşılaşmadığımız bazı yeni terimlerin yanında ilgili literatürü incelerken kolaylık sağlamak amacıyla \ningilizce karşılıkları da verildi)', 4, 'img/posts/yasamKalitesi.jpg', '2021-09-08 11:14:40', 4, 'http://cms.galenos.com.tr/Uploads/Article_8598/25-29.pdf');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`author_id`);

--
-- Tablo için indeksler `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Tablo için indeksler `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `author`
--
ALTER TABLE `author`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
