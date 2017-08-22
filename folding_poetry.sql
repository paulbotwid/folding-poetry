-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Aug 22, 2017 at 02:39 PM
-- Server version: 5.5.42
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `folding_poetry`
--

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `poem_id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `poems`
--

CREATE TABLE `poems` (
  `id` int(11) NOT NULL,
  `poem` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `line_count` int(11) NOT NULL,
  `bg_color` text COLLATE utf8mb4_bin NOT NULL,
  `styles` text CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=188 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `poems`
--

INSERT INTO `poems` (`id`, `poem`, `last_update`, `line_count`, `bg_color`, `styles`) VALUES
(154, '<span class="poem-line" data-color="#202020" data-location="Stockholm, Sweden"> Okay let''s see what we''ve got<br>It''s so</span><span class="poem-line" data-color="#ff2f67" data-location="Stockholm, Sweden"> exciting right now<br>I can hardly</span><span class="poem-line" data-color="#F932FC" data-location="Stockholm, Sweden"> contain it<br>Let''s go, right</span><span class="poem-line" data-color="#00fffb" data-location="Stockholm, Sweden"> to bed my dear<br><br>I''m exhausted</span><span class="poem-line" data-color="#00fffb" data-location="Stockholm, Sweden"> from the heat<br>Leave me be</span><span class="poem-line" data-color="#ff2f67" data-location="Stockholm, Sweden">,  I''m begging you?<br>Weird thing</span><span class="poem-line" data-color="#202020" data-location="Stockholm, Sweden"> to ask if I may say so mayself<br><br>For myself</span><span class="poem-line" data-color="#ff2f67" data-location="Stockholm, Sweden"> I''ve always fancied tea in the<br>parking lot</span><span class="poem-line" data-color="#ff2f67" data-location="Stockholm, Sweden">,  as if that would help the<br>children sing</span><span class="poem-line" data-color="#202020" data-location="Stockholm, Sweden"> <br><br>Please let it be done with</span>', '2017-07-03 11:28:04', 10, '#f9f9f9', 'text-transform: lowercase;font-style: normal;color: #202020;font-weight: 800;font-family: Shrikhand;'),
(155, '<span class="poem-line" data-color="#f9f9f9" data-location="Stockholm, Sweden"> How do I want it to look in the end<br>Would it be</span><span class="poem-line" data-color="#202020" data-location="Stockholm, Sweden"> ever changing?<br>Maybe that''s</span><span class="poem-line" data-color="#00fffb" data-location="Stockholm, Sweden"> too busy<br><br>Let me think</span><span class="poem-line" data-color="#00fffb" data-location="Stockholm, Sweden"> about it for a minute<br>God it''s gettin</span><span class="poem-line" data-color="#202020" data-location="Stockholm, Sweden"> hot today, bring in the ice<br>tea</span>', '2017-07-03 11:33:17', 5, '#0bffbd', 'text-transform: uppercase;font-style: normal;color: #202020;font-weight: 800;font-family: Rakkas;'),
(156, '<span class="poem-line" data-color="#ff2f67" data-location="Stockholm, Sweden"> I''m not sure how to put it<br>It just comes</span><span class="poem-line" data-color="#F932FC" data-location="Stockholm, Sweden"> to me, and I roll with it<br>don''t take it</span><span class="poem-line" data-color="#202020" data-location="Stockholm, Sweden"> too personally dear<br>It''s only loce</span>', '2017-07-03 13:25:50', 3, '#fffc00', 'text-transform: default;font-style: normal;color: #202020;font-weight: 800;font-family: Shrikhand;'),
(157, '<span class="poem-line" data-color="#F932FC" data-location="Stockholm, Sweden"> If ever we should build a house<br>Let''s have</span><span class="poem-line" data-color="#202020" data-location="Stockholm, Sweden"> chickens<br><br>Please, don''t</span><span class="poem-line" data-color="#fffc00" data-location="Stockholm, Sweden"> laugh, it makes me feel old<br>I''m too old</span>', '2017-07-03 13:28:53', 3, '#00fffb', 'text-transform: lowercase;font-style: italic;color: #fffc00;font-weight: 300;font-family: Rakkas;'),
(158, '<span class="poem-line" data-color="#202020" data-location="Stockholm, Sweden"> You and I should go away some day, just<br>the two of us</span><span class="poem-line" data-color="#202020" data-location="Stockholm, Sweden"> could start a war<br>a war on</span><span class="poem-line" data-color="#ff2f67" data-location="Stockholm, Sweden"> everything that god forgot<br>I''m sure there''s something</span>', '2017-07-03 13:55:58', 3, '#202020', 'text-transform: default;font-style: normal;color: #ff2f67;font-weight: 100;font-family: Shrikhand;'),
(159, '<span class="poem-line" data-color="#00fffb" data-location="Stockholm, Sweden"> I''m not at all bored by this<br>really</span><span class="poem-line" data-color="#fffc00" data-location="Stockholm, Sweden">,  is that what you think?<br>Well bloody</span><span class="poem-line" data-color="#202020" data-location="Stockholm, Sweden"> hell then<br><br>I''m going to find another drinking buddy</span>', '2017-07-03 14:00:15', 3, '#9eff3d', 'text-transform: default;font-style: normal;color: #202020;font-weight: 300;font-family: Shrikhand;'),
(160, '<span class="poem-line" data-color="#00fffb" data-location="Stockholm, Sweden"> You can''t say I didn''t try<br><br>I promise</span><span class="poem-line" data-color="#00fffb" data-location="Stockholm, Sweden"> I won''t give in too easily<br>this time</span><span class="poem-line" data-color="#ff2f67" data-location="Stockholm, Sweden">,  it''s more than a promise<br><br>It''s not just about love</span>', '2017-07-03 18:28:08', 3, '#202020', 'text-transform: uppercase;font-style: normal;color: #ff2f67;font-weight: 800;font-family: Ubuntu;'),
(161, '<span class="poem-line" data-color="#202020" data-location="Stockholm, Sweden"> you can''t be serious<br>what about</span><span class="poem-line" data-color="#f9f9f9" data-location="Stockholm, Sweden"> the other day?<br><br>What about it?</span><span class="poem-line" data-color="#fffc00" data-location="Stockholm, Sweden"> <br><br>I don''t know</span><span class="poem-line" data-color="#00fffb" data-location="Stockholm, Sweden"> yet, I''m figuring myself out<br>Thanks for listening</span>', '2017-07-03 20:13:33', 4, '#0bffbd', 'text-transform: lowercase;font-style: normal;color: #00fffb;font-weight: 100;font-family: Arbutus Slab;'),
(162, '<span class="poem-line" data-color="#202020" data-location="Stockholm, Sweden"> I''m talking to myself again<br>I''m longing</span><span class="poem-line" data-color="#ff2f67" data-location="Stockholm, Sweden"> for every breath away from pain<br>It''s not that</span><span class="poem-line" data-color="#fffc00" data-location="Stockholm, Sweden"> I''m not breathing<br>it''s just pain finds its way into many</span>', '2017-07-03 20:45:49', 3, '#F932FC', 'text-transform: default;font-style: italic;color: #fffc00;font-weight: 400;font-family: Shrikhand;'),
(163, '<span class="poem-line" data-color="#f9f9f9" data-location="Stockholm, Sweden"> OK go<br>go go go</span><span class="poem-line" data-color="#fffc00" data-location="Stockholm, Sweden"> you go ashole<br>leave me alone</span><span class="poem-line" data-color="#202020" data-location="Stockholm, Sweden"> well you leave me alone now<br>seriously go go</span><span class="poem-line" data-color="#F932FC" data-location="Stockholm, Sweden"> what the actuall fuck is wrong<br>with you, GO!!!</span><span class="poem-line" data-color="#fffc00" data-location="Stockholm, Sweden"> AWAY!!!! i dont want to talk to<br>i want to write poetry. okay bye<br><br></span>', '2017-07-03 21:01:02', 5, '#9eff3d', 'text-transform: default;font-style: italic;color: #fffc00;font-weight: 500;font-family: Shrikhand;'),
(164, '<span class="poem-line" data-color="#00fffb" data-location="Stockholm, Sweden"> NOW THEN<br>Please</span><span class="poem-line" data-color="#0043ef" data-location="Stockholm, Sweden"> WFT what happend to you to  make<br>you like this??</span><span class="poem-line" data-color="#F932FC" data-location="Stockholm, Sweden"> well what make you a bag of shit<br>as fuck. any way. I LOVE YOU</span>', '2017-07-03 21:05:57', 3, '#0043ef', 'text-transform: default;font-style: normal;color: #F932FC;font-weight: 100;font-family: Arbutus Slab;'),
(165, '<span class="poem-line" data-color="#202020" data-location="Stockholm, Sweden"> I''m not as excited anymore<br>Could you</span><span class="poem-line" data-color="#0043ef" data-location="Stockholm, Sweden"> please let me go<br>I''m telling</span><span class="poem-line" data-color="#202020" data-location="Stockholm, Sweden"> you to stop and go,<br>stop and go</span><span class="poem-line" data-color="#f9f9f9" data-location="Stockholm, Sweden"> - stop to see<br>It''s sunny outside</span>', '2017-07-05 13:13:46', 4, '#202020', 'text-transform: default;font-style: normal;color: #f9f9f9;font-weight: 400;font-family: Arbutus Slab;'),
(166, '<span class="poem-line" data-color="#202020" data-location="Stockholm, Sweden"> I''m not talking about the horses anymore<br>I''m over it</span><span class="poem-line" data-color="#fffc00" data-location="Stockholm, Sweden">,  and don''t go thinking I''m not<br>Because I am</span><span class="poem-line" data-color="#0043ef" data-location="Stockholm, Sweden"> not afraid to tell you how<br>I feel</span><span class="poem-line" data-color="#202020" data-location="Stockholm, Sweden"> to tired and fuzzy in my head<br>Let go</span>', '2017-07-05 13:23:24', 4, '#f9f9f9', 'text-transform: default;font-style: italic;color: #202020;font-weight: 300;font-family: Ubuntu;'),
(167, '<span class="poem-line" data-color="#fffc00" data-location="Stockholm, Sweden"> Hello again<br>omg</span><span class="poem-line" data-color="#F932FC" data-location="Stockholm, Sweden"> its again<br>again</span><span class="poem-line" data-color="#fffc00" data-location="Stockholm, Sweden"> and again<br>om</span>', '2017-07-05 13:46:25', 3, '#202020', 'text-transform: default;font-style: italic;color: #fffc00;font-weight: 800;font-family: Arbutus Slab;'),
(168, '<span class="poem-line" data-color="#0043ef" data-location="Stockholm, Sweden"> Don''t let me say it too many times<br>I''m telling you</span><span class="poem-line" data-color="#202020" data-location="Stockholm, Sweden"> it''s not my fault, it never is<br>So come on, let</span><span class="poem-line" data-color="#ff2f67" data-location="Stockholm, Sweden"> me have it<br><br>I''m not the one</span><span class="poem-line" data-color="#f9f9f9" data-location="Stockholm, Sweden"> to bother the dead<br>with troubles</span>', '2017-07-05 14:03:45', 4, '#0043ef', 'text-transform: lowercase;font-style: italic;color: #f9f9f9;font-weight: 800;font-family: Ubuntu;'),
(169, '<span class="poem-line" data-color="#202020" data-location="Stockholm, Sweden"> I''m saying the same things over and over<br>Again, and</span><span class="poem-line" data-color="#fffc00" data-location="Stockholm, Sweden"> again, again and again<br>We''re here</span><span class="poem-line" data-color="#fffc00" data-location="Stockholm, Sweden"> now, so let''s talk<br>I''m seriously</span><span class="poem-line" data-color="#F932FC" data-location="Stockholm, Sweden"> mad right<br>now</span><span class="poem-line" data-color="#f9f9f9" data-location="Stockholm, Sweden"> I''m talking about<br>you</span>', '2017-07-05 14:13:29', 5, '#0043ef', 'text-transform: default;font-style: normal;color: #f9f9f9;font-weight: 400;font-family: Rakkas;'),
(170, '<span class="poem-line" data-color="#fffc00" data-location="Stockholm, Sweden"> It''s only love and that is all<br>So why should I</span><span class="poem-line" data-color="#fffc00" data-location="Stockholm, Sweden"> feel the way I do<br>Oh</span><span class="poem-line" data-color="#f9f9f9" data-location="Stockholm, Sweden"> that sorrow I feel in this<br>Room</span><span class="poem-line" data-color="#ff2f67" data-location="Stockholm, Sweden"> s are talking<br>to me all night, let me go</span>', '2017-07-05 14:13:51', 4, '#202020', 'text-transform: lowercase;font-style: italic;color: #ff2f67;font-weight: 400;font-family: Rakkas;'),
(171, '<span class="poem-line" data-color="#0043ef" data-location="Stockholm, Sweden"> Come on now<br>where did you g</span><span class="poem-line" data-color="#202020" data-location="Stockholm, Sweden"> o<br>now</span><span class="poem-line" data-color="#fffc00" data-location="Stockholm, Sweden"> I''m not talking about you any<br>more than you</span><span class="poem-line" data-color="#202020" data-location="Stockholm, Sweden"> know<br>that</span><span class="poem-line" data-color="#202020" data-location="Stockholm, Sweden"> is good<br>hey</span>', '2017-07-05 14:19:08', 5, '#f9f9f9', 'text-transform: lowercase;font-style: italic;color: #202020;font-weight: 800;font-family: Rakkas;'),
(172, '<span class="poem-line" data-color="#202020" data-location="Stockholm, Sweden"> come on<br>what''s</span><span class="poem-line" data-color="#fffc00" data-location="Stockholm, Sweden"> the matter<br>Fine I get it</span><span class="poem-line" data-color="#202020" data-location="Stockholm, Sweden">,  and I''m not mad about it going<br>to hell</span><span class="poem-line" data-color="#0043ef" data-location="Stockholm, Sweden"> with all your conventions<br>This is</span><span class="poem-line" data-color="#fffc00" data-location="Stockholm, Sweden"> my only way of saying it<br>if I don''t</span>', '2017-07-05 14:22:42', 5, '#f9f9f9', 'text-transform: default;font-style: italic;color: #fffc00;font-weight: 500;font-family: Ubuntu;'),
(173, '<span class="poem-line" data-color="#ff2f67" data-location="Stockholm, Sweden"> now<br>then</span><span class="poem-line" data-color="#202020" data-location="Stockholm, Sweden"> I''m<br>not</span><span class="poem-line" data-color="#202020" data-location="Stockholm, Sweden"> your choice to make<br>But let''s not say things too often</span>', '2017-07-05 14:23:26', 3, '#F932FC', 'text-transform: default;font-style: normal;color: #202020;font-weight: 400;font-family: Shrikhand;'),
(174, '<span class="poem-line" data-color="#0043ef" data-location="Stockholm, Sweden"> You have got me going on again and again<br>Don''t you know</span><span class="poem-line" data-color="#202020" data-location="Stockholm, Sweden"> I''ve been trying to<br>tell you</span><span class="poem-line" data-color="#f9f9f9" data-location="Stockholm, Sweden"> to come again<br>tell you to</span><span class="poem-line" data-color="#0043ef" data-location="Stockholm, Sweden"> go away slowly, I''m not happy<br>so I''ll let you</span><span class="poem-line" data-color="#F932FC" data-location="Stockholm, Sweden"> go again<br><br>I guess I''ll let you go again</span>', '2017-07-05 20:37:54', 5, '#ff2f67', 'text-transform: uppercase;font-style: normal;color: #F932FC;font-weight: 300;font-family: Rakkas;'),
(175, '<span class="poem-line" data-color="#F932FC" data-location="Stockholm, Sweden"> Now then<br>What''s</span><span class="poem-line" data-color="#202020" data-location="Stockholm, Sweden"> up with all the hanging around<br>I''m troubled</span><span class="poem-line" data-color="#ff2f67" data-location=", Sweden"> <br><br>No, not really</span>', '2017-07-06 07:37:44', 3, '#f9f9f9', 'text-transform: lowercase;font-style: normal;color: #ff2f67;font-weight: 800;font-family: Shrikhand;'),
(176, '<span class="poem-line" data-color="#f9f9f9" data-location="Stockholm, Sweden"> Hello mister postman, let me see you<br>I''m not coming</span><span class="poem-line" data-color="#202020" data-location="Stockholm, Sweden"> home tonight ma<br>You never treat</span><span class="poem-line" data-color="#0043ef" data-location=", Sweden"> me as well as you said you would<br>let me be</span><span class="poem-line" data-color="#ff2f67" data-location=", Sweden"> hopeless and helpless again<br>I''d rather not lose hope</span>', '2017-07-06 07:45:33', 4, '#0043ef', 'text-transform: lowercase;font-style: normal;color: #ff2f67;font-weight: 500;font-family: Ubuntu;'),
(177, '<span class="poem-line" data-color="#202020" data-location=", Sweden"> Hello all of you<br>Sitting in my</span><span class="poem-line" data-color="#0043ef" data-location=", Sweden"> own space<br>Sitting on my</span><span class="poem-line" data-color="#202020" data-location=", Sweden"> hey<br>go</span>', '2017-07-06 07:55:57', 3, '#f9f9f9', 'text-transform: uppercase;font-style: normal;color: #202020;font-weight: 100;font-family: Rakkas;'),
(178, '<span class="poem-line" data-color="#f9f9f9" data-location=", Sweden"> Okay last one before coffee<br>Im  a longing</span><span class="poem-line" data-color="#f9f9f9" data-location=", Sweden"> for belonging. I wanna hope but<br>not too much</span><span class="poem-line" data-color="#fffc00" data-location=", Sweden"> to hear you say<br>hey</span><span class="poem-line" data-color="#fffc00" data-location=", Sweden">, <br><br>grow up</span>', '2017-07-06 08:26:30', 4, '#D800FF', 'text-transform: uppercase;font-style: italic;color: #fffc00;font-weight: 400;font-family: Anton;'),
(179, '<span class="poem-line" data-color="#0043ef" data-location=", Sweden"> I have another thought about the fall<br>of man</span><span class="poem-line" data-color="#0043ef" data-location="Malmo, Sweden"> and dog, you don''t see much<br>these days</span><span class="poem-line" data-color="#ff2f67" data-location="Malmo, Sweden"> don''t come running fast enough<br>these dogs</span><span class="poem-line" data-color="#0043ef" data-location="Malmo, Sweden"> are nuthin but cheap cats<br>longing for the woods</span>', '2017-07-16 21:40:49', 4, '#f9f9f9', 'text-transform: lowercase;font-style: italic;color: #0043ef;font-weight: 400;font-family: Shrikhand;'),
(180, '<span class="poem-line" data-color="#ff2f67" data-location="Stockholm, Sweden"> I''m talking about the good times,<br>The lookyloos</span><span class="poem-line" data-color="#f9f9f9" data-location="Malmo, Sweden"> have all gone to sleep<br>All the</span><span class="poem-line" data-color="#fffc00" data-location="Malmo, Sweden"> help in the world could never<br>use me</span><span class="poem-line" data-color="#202020" data-location=", "> til<br>it over</span>', '2017-07-17 20:27:27', 4, '#D800FF', 'text-transform: uppercase;font-style: normal;color: #202020;font-weight: 800;font-family: Shrikhand;'),
(181, '<span class="poem-line" data-color="#fffc00" data-location="Malmo, Sweden"> omg i here<br>again</span><span class="poem-line" data-color="#ff2f67" data-location=", "> and again and again<br>It goes</span><span class="poem-line" data-color="#fffc00" data-location="Stockholm, Sweden"> like boom boom<br>And then I''m like </span>', '2017-08-22 12:39:24', 3, '#202020', 'text-transform: lowercase;font-style: italic;color: #fffc00;font-weight: 400;font-family: Questrial;'),
(182, '<span class="poem-line" data-color="#fffc00" data-location="Malmo, Sweden"> it''s never as bad as it seems<br>sometimes</span><span class="poem-line" data-color="#202020" data-location="Malmo, Sweden"> it''s not as easy as it seems<br>but you should</span><span class="poem-line" data-color="#0043ef" data-location="Stockholm, Sweden"> go again<br>Right?</span>', '2017-07-20 21:13:38', 3, '#f9f9f9', 'text-transform: default;font-style: normal;color: #0043ef;font-weight: 500;font-family: Rakkas;'),
(185, '<span class="poem-line" data-color="#f9f9f9" data-location="Stockholm, Sweden"> This is my last goodbye<br>let it sing</span><span class="poem-line" data-color="#202020" data-location="Stockholm, Sweden"> it<br>to see the 🔥 i</span><span class="poem-line" data-color="#0043ef" data-location="Stockholm, Sweden"> need to get going<br>it never happen</span><span class="poem-line" data-color="#D800FF" data-location="Stockholm, Sweden"> to an angel<br>are you an 😇</span><span class="poem-line" data-color="#202020" data-location="Stockholm, Sweden"> ?<br>I''m just asking, the 🥑 is on its way</span>', '2017-07-21 20:11:23', 5, '#ff2f67', 'text-transform: uppercase;font-style: normal;color: #202020;font-weight: 500;font-family: Anton;'),
(187, '<span class="poem-line" data-color="#0043ef" data-location="Stockholm, Sweden"> Hello<br>I''m testing</span><span class="poem-line" data-color="#ff2f67" data-location="Sweden"> it again,<br>hopefully it</span><span class="poem-line" data-color="#ffe700" data-location="Sweden"> is not too long til honesty<br>takes over me once more</span>', '2017-08-14 16:28:48', 3, '#0bffbd', 'text-transform: lowercase;font-style: italic;color: #ffe700;font-weight: 100;font-family: Rakkas;');

-- --------------------------------------------------------

--
-- Table structure for table `working_poems`
--

CREATE TABLE `working_poems` (
  `id` int(11) NOT NULL,
  `working_poem` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_line` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `curr_line_count` int(11) NOT NULL DEFAULT '0',
  `target_line_count` int(11) NOT NULL DEFAULT '0',
  `in_use` tinyint(1) NOT NULL DEFAULT '0',
  `color` text CHARACTER SET latin1 NOT NULL,
  `styles` text CHARACTER SET latin1 NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=138 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `working_poems`
--

INSERT INTO `working_poems` (`id`, `working_poem`, `last_line`, `curr_line_count`, `target_line_count`, `in_use`, `color`, `styles`, `last_update`) VALUES
(130, '<span class="poem-line" data-color="#f9f9f9" data-location="Sweden">%l1s%does it not go away?%l1e%%l2s%say%l2e%</span><span class="poem-line" data-color="#202020" data-location="Sweden">%l1s%it again%l1e%%l2s%hey%l2e%</span>', 'hey', 2, 3, 1, '#202020', '', '2017-08-22 12:39:26'),
(131, '', '', 0, 0, 0, '', '', '2017-08-14 16:34:56'),
(132, '', '', 0, 0, 0, '', '', '2017-07-21 18:59:10'),
(133, '', '', 0, 0, 0, '', '', '2017-07-21 18:59:04'),
(134, '', '', 0, 0, 0, '', '', '2017-07-20 23:42:17'),
(135, '', '', 0, 0, 0, '', '', '2017-07-21 18:57:56'),
(136, '', '', 0, 0, 0, '', '', '2017-08-14 16:28:08'),
(137, '', '', 0, 0, 0, '', '', '2017-08-14 16:28:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poems`
--
ALTER TABLE `poems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `working_poems`
--
ALTER TABLE `working_poems`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `poems`
--
ALTER TABLE `poems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=188;
--
-- AUTO_INCREMENT for table `working_poems`
--
ALTER TABLE `working_poems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=138;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
