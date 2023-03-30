-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql101.byetcluster.com
-- Generation Time: Jan 31, 2022 at 12:23 PM
-- Server version: 10.3.27-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_30712291_instadoc19`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `at_id` int(10) NOT NULL,
  `at_title` varchar(1000) NOT NULL,
  `at_short_info` varchar(500) NOT NULL,
  `at_info` mediumtext NOT NULL,
  `at_image` varchar(100) NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`at_id`, `at_title`, `at_short_info`, `at_info`, `at_image`, `user_id`) VALUES
(2, 'How does healthy food improve your mood?', 'foods like protein which is most available in dairy products can quickly break down in your digestive system', 'Healthy foods like protein which is most available in dairy products can quickly break down in your digestive system and stop you from stressing too much. Just like eggs and dairy products, many other foods can also improve a personâ€™s mood.', 'images/61e7d37d24ac25.40697327.jfif', 3),
(3, 'How to be happy', 'the freedom to pursue your deepest dreams.', 'Happiness looks different for everyone. For you, maybe itâ€™s being at peace with who you are. Or having a secure network of friends who accept you unconditionally. Or the freedom to pursue your deepest dreams.\r\n\r\nRegardless of your version of true happiness, living a happier, more satisfied life is within reach. A few tweaks to your regular habits can help you get there.\r\n\r\nHabits matter. If youâ€™ve ever tried breaking a bad habit, you know all too well how engrained they are.\r\n\r\nWell, good habits are deeply engrained, too. Why not work on making positive habits part of your routine?\r\n\r\nHereâ€™s a look at some daily, monthly, and yearly habits to help kickstart your quest. Just remember that everyoneâ€™s version of happiness is a little different, and so is their path to achieving it.\r\n\r\nIf some of these habits create added stress or just donâ€™t fit your lifestyle, ditch them. With a little time and practice, youâ€™ll figure out what does and doesnâ€™t work for you.\r\n1. Smile. You tend to smile when youâ€™re happy. But itâ€™s actually a two-way street.\r\n2. Exercise.\r\n3. Get plenty of sleep.\r\n4. Eat with mood in mind.\r\n5. Be grateful.', 'images/61e7d484378af8.83815836.jpg', 3),
(5, 'How does healthy food improve your mood?', 'foods like protein which is most available in dairy products can quickly break down in your digestive system', 'Healthy foods like protein which is most available in dairy products can quickly break down in your digestive system and stop you from stressing too much. Just like eggs and dairy products, many other foods can also improve a personâ€™s mood.', 'images/61f81648f40ff9.82871698.jfif', 6);

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chat_id` int(100) NOT NULL,
  `chat_msg` mediumtext NOT NULL,
  `chat_time` varchar(21) NOT NULL,
  `chat_from_uid` int(10) NOT NULL,
  `chat_to_uid` int(10) NOT NULL,
  `chat_seq_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`chat_id`, `chat_msg`, `chat_time`, `chat_from_uid`, `chat_to_uid`, `chat_seq_id`) VALUES
(1, 'hi', '05 Jan 2022, 05:51 PM', 4, 5, 4),
(2, 'hello', '05 Jan 2022, 05:53 PM', 4, 5, 5),
(6, 'hi', '13 Jan 2022, 10:07 AM', 4, 5, 4),
(7, 'hi\n', '19 Jan 2022, 03:01 PM', 1, 3, 3),
(8, 'Hello doctor', '19 Jan 2022, 03:01 PM', 1, 3, 1),
(9, 'how are you\n', '19 Jan 2022, 03:02 PM', 1, 3, 3),
(10, 'again hello', '31 Jan 2022, 06:38 PM', 1, 3, 3),
(11, 'hi\n', '31 Jan 2022, 06:39 PM', 1, 3, 3),
(12, 'hello', '31 Jan 2022, 06:47 PM', 1, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `chatrequest`
--

CREATE TABLE `chatrequest` (
  `cr_id` int(20) NOT NULL,
  `cr_from_id` int(10) NOT NULL,
  `cr_to_id` int(10) NOT NULL,
  `cr_status` int(10) NOT NULL,
  `cr_video_link` varchar(500) NOT NULL,
  `cr_passcode` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chatrequest`
--

INSERT INTO `chatrequest` (`cr_id`, `cr_from_id`, `cr_to_id`, `cr_status`, `cr_video_link`, `cr_passcode`) VALUES
(8, 1, 3, 1, 'https://us04web.zoom.us/j/74108891435?pwd=opol0iF7yW_GWfKjh32M6gQtHWJwMX.1', 'instant22');

-- --------------------------------------------------------

--
-- Table structure for table `disease`
--

CREATE TABLE `disease` (
  `ds_id` int(10) NOT NULL,
  `ds_name` varchar(500) NOT NULL,
  `ds_info` mediumtext NOT NULL,
  `ds_image` varchar(100) NOT NULL,
  `ds_doctor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `disease`
--

INSERT INTO `disease` (`ds_id`, `ds_name`, `ds_info`, `ds_image`, `ds_doctor`) VALUES
(2, 'Abdominal ', 'Abdominal pain Discomfort or pain in the area between chest and the pelvis:-\r\nCommon Causes\r\nAbdominal pain is not always related to an underlying condition. It may be caused by:\r\nâ€¢	Constipation\r\nâ€¢	Menstrual cramps\r\nâ€¢	Indigestion\r\nâ€¢	Overeating\r\nâ€¢	Gas due to indigestion\r\nâ€¢	Pulled or strained muscles\r\n', 'images/61e7cf4e8dbea4.28983398.png', '3'),
(3, 'Anxiety', 'Fear characterized by behavioural disturbances.\r\nCommon Causes\r\nAnxiety is not always related to an underlying condition. It may be caused by:\r\nâ€¢	Stress that can result from work, school, personal relationship\r\nâ€¢	Emotional trauma\r\nâ€¢	Financial concerns\r\nâ€¢	Stress caused by a chronic or serious medical condition\r\nâ€¢	A major event or performance\r\nâ€¢	Side effect of certain medications\r\nâ€¢	Alcohol consumption, drugs such as cocaine\r\nâ€¢	Lack of oxygen\r\n', 'images/61e7cfd3651fe0.29260963.png', '3'),
(4, 'Cold', 'The first signs of the common cold are fairly obvious: a stuffy or runny nose, sneezing, and a scratchy, sore throat. Most people quickly recognize these early symptoms because the common cold is so ordinary. In fact, adults have an average of 2 to 3 colds per year. The common cold is actually a viral infection in your upper respiratory tract.', 'images/61e7d06f3d4670.56535677.png', '3'),
(5, 'Constipation', 'Constipation\r\nInfrequent, irregular or difficult evacuation of the bowels.\r\nCommon Causes\r\nConstipation is not always related to an underlying condition. It may be caused by:\r\nâ€¢	Insufficient quantities of fibre and water in meals\r\nâ€¢	Changes in diet or normal activities\r\nâ€¢	Physical inactivity\r\nâ€¢	Holding stool for long periods even with the urge\r\nâ€¢	Drugs such as narcotics, antidepressants, and anti- acids (especially those rich in Ca and Al)\r\n', 'images/61e7d0a32ef094.43211820.png', '3'),
(6, 'Cough', 'A reflex action involving sudden noisy expulsion of air from the lungs.\r\nCommon Causes\r\nCough is not always related to an underlying condition. It may be caused by:\r\nâ€¢	Irritants such as smoke, dust\r\nâ€¢	Drug side effects\r\nâ€¢	Improperly swallowing food or water\r\nâ€¢	Post nasal drip\r\n', 'images/61e7d1213f1492.74353774.png', '3'),
(7, 'Headache', 'A common symptom that causes pain and discomfort in the head or neck region.\r\nCommon Causes\r\nHeadache is not always related to an underlying condition. It may be caused by:\r\nâ€¢	Stress\r\nâ€¢	Emotional distress\r\nâ€¢	Infections\r\n', 'images/61e7d175ca0d38.21912185.png', '3'),
(8, 'Ear Pain', 'Pain felt in or around the ears which usually occurs in only one ear.\r\nCommon Causes\r\nEar pain is not always related to an underlying condition. It may be caused by:\r\nâ€¢	Earwax accumulation\r\nâ€¢	Changes in pressure\r\nâ€¢	Foreign object entrapment\r\nâ€¢	Infected/impacted tooth\r\nâ€¢	Ear piercings\r\nâ€¢	Tight head wear\r\n', 'images/61e7d1db1750c5.63029042.png', '3'),
(9, 'Abdominal ', 'Abdominal pain Discomfort or pain in the area between chest and the pelvis:-\r\nCommon Causes\r\nAbdominal pain is not always related to an underlying condition. It may be caused by:\r\nâ€¢	Constipation\r\nâ€¢	Menstrual cramps\r\nâ€¢	Indigestion\r\nâ€¢	Overeating\r\nâ€¢	Gas due to indigestion\r\nâ€¢	Pulled or strained muscles\r\n', 'images/61f817ec8ee9f3.88734497.png', '6'),
(10, 'Anxiety', 'Fear characterized by behavioural disturbances.\r\nCommon Causes\r\nAnxiety is not always related to an underlying condition. It may be caused by:\r\nâ€¢	Stress that can result from work, school, personal relationship\r\nâ€¢	Emotional trauma\r\nâ€¢	Financial concerns\r\nâ€¢	Stress caused by a chronic or serious medical condition\r\nâ€¢	A major event or performance\r\nâ€¢	Side effect of certain medications\r\nâ€¢	Alcohol consumption, drugs such as cocaine\r\nâ€¢	Lack of oxygen\r\n', 'images/61f818392de581.64570350.png', '6'),
(11, 'Cold', 'The first signs of the common cold are fairly obvious: a stuffy or runny nose, sneezing, and a scratchy, sore throat. Most people quickly recognize these early symptoms because the common cold is so ordinary. In fact, adults have an average of 2 to 3 colds per year. The common cold is actually a viral infection in your upper respiratory tract.', 'images/61f8188fe334e8.01695453.png', '6'),
(12, 'Constipation', 'Constipation Infrequent, irregular or difficult evacuation of the bowels. Common Causes Constipation is not always related to an underlying condition. It may be caused by: â€¢ Insufficient quantities of fibre and water in meals â€¢ Changes in diet or normal activities â€¢ Physical inactivity â€¢ Holding stool for long periods even with the urge â€¢ Drugs such as narcotics, antidepressants, and anti- acids (especially those rich in Ca and Al)', 'images/61f818b402ad00.07533276.png', '6'),
(13, 'Headache', 'A common symptom that causes pain and discomfort in the head or neck region. Common Causes Headache is not always related to an underlying condition. It may be caused by: â€¢ Stress â€¢ Emotional distress â€¢ Infections', 'images/61f818f5a16985.37201436.png', '6');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doc_id` int(10) NOT NULL,
  `bio` varchar(1000) NOT NULL,
  `specialist` varchar(500) NOT NULL,
  `experience` varchar(500) NOT NULL,
  `qualification` varchar(500) NOT NULL,
  `language` varchar(500) NOT NULL,
  `docimage` varchar(100) NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doc_id`, `bio`, `specialist`, `experience`, `qualification`, `language`, `docimage`, `user_id`) VALUES
(2, '5 years of excellent experience in instadoc19. Specialist on Hair, Skin and Nails.', 'Dermatology', '5', 'M.B.B.S., D.N.B.', 'Hindi, English', 'images/61e7d8ba1d2aa4.80261264.jpg', 3),
(3, 'I am a cardiologist ,obtained a 5-year undergraduate degree in pre-med with an emphasis on science. Complete a 5-year general surgery residency program.', 'Heart', '5 years', 'MBBS', 'Hindi, English', 'images/61f812361e7186.64137480.jpeg', 6);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int(10) NOT NULL,
  `mobilenumber` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(500) NOT NULL,
  `identity` varchar(50) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(500) NOT NULL,
  `dob` varchar(50) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `mobilenumber`, `email`, `password`, `identity`, `firstname`, `lastname`, `dob`, `gender`, `city`, `state`, `date`) VALUES
(1, '1234567890', 'test@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'simple_user19', 'test', 'testing', '22-02-2000', 'm', 'raipur', 'cg', '02 Jan 2022, 05:36 PM'),
(3, '1234567899', 'johndoe@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'doc_on19', 'John', 'Doe', '22-02-1989', 'Fimale', 'raipur', 'cg', '03 Jan 2022, 06:50 PM'),
(4, '1', 'm@g.c', '6f8f57715090da2632453988d9a1501b', 'simple_user19', 'm', 'p', '01/03/1999', 'm', 'r', 'c', '05 Jan 2022, 04:18 PM'),
(5, '2', 'm2@g.c', '6f8f57715090da2632453988d9a1501b', 'doc_on19', 'm', 'p', '01/03/1999', 'm', 'r', 'c', '05 Jan 2022, 05:34 PM'),
(6, '9165882117', 'hdhimanshu670@gmail.com', '140ad45662785f91e08bb3e15c417899', 'doc_on19', 'Himanshu', 'Rajak', '04/04/1995', 'm', 'Raipur', 'Chhattisgarh', '31 Jan 2022, 10:15 PM'),
(7, '9340475779', 'psahu2087@gmail.com', 'd35c83099d9e6290a9880630e06746bf', 'simple_user19', 'Pankaj ', 'Sahu', '22/20/2000', 'm', 'Raipur', 'Chhattisgarh', '31 Jan 2022, 10:53 PM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`at_id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `chatrequest`
--
ALTER TABLE `chatrequest`
  ADD PRIMARY KEY (`cr_id`);

--
-- Indexes for table `disease`
--
ALTER TABLE `disease`
  ADD PRIMARY KEY (`ds_id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `at_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chat_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `chatrequest`
--
ALTER TABLE `chatrequest`
  MODIFY `cr_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `disease`
--
ALTER TABLE `disease`
  MODIFY `ds_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doc_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
