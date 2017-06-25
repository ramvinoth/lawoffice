CREATE TABLE `copy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `case_no` varchar(200) NOT NULL,
  `case_no1` varchar(200) NOT NULL,
  `receipt_no` varchar(200) NOT NULL,
  `date_receipt` varchar(200) NOT NULL,
  `dispatched` varchar(200) NOT NULL,
  `received` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO copy VALUES("5","./","","","","","");


CREATE TABLE `courier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` varchar(200) NOT NULL,
  `receiver` varchar(200) NOT NULL,
  `destination` varchar(200) NOT NULL,
  `receipt_no` varchar(200) NOT NULL,
  `sent_date` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO courier VALUES("2","H.Arumugam","elancier","madurai","213","27/12/13");
INSERT INTO courier VALUES("3","H.Arumugam","Shankar","Chennai","173","27/12/13");


CREATE TABLE `miscillaneous` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mdate` varchar(200) NOT NULL,
  `party` varchar(200) NOT NULL,
  `refer` varchar(200) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `contact` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO miscillaneous VALUES("2","19/01/2014","Ratnavel Crl.O.P","K.Selvaraj, Advocate","FIR","");
INSERT INTO miscillaneous VALUES("3","18/01/2014","karuppi-OP","Indramani,  Advocate","","");
INSERT INTO miscillaneous VALUES("4","18/01/2014","Ramachandran-OP","V.Vinoth, Ad","Writ-","");
INSERT INTO miscillaneous VALUES("6","19/01/2014","Michael Raj-WP","Philip, Mukkoodal","Patta","");


CREATE TABLE `received` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` varchar(200) NOT NULL,
  `receiver` varchar(200) NOT NULL,
  `sent_from` varchar(200) NOT NULL,
  `receipt_no` varchar(200) NOT NULL,
  `received_date` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO received VALUES("2","Shankar","H.Arumugam","Dindugal","175","27/12/13");


CREATE TABLE `slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slider_image` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO slider VALUES("1","images/slider/slide-1.jpg");
INSERT INTO slider VALUES("2","images/slider/slide-2.jpg");
INSERT INTO slider VALUES("3","images/slider/slide-3.jpg");
INSERT INTO slider VALUES("4","images/slider/slide-4.jpg");


CREATE TABLE `websites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(300) NOT NULL,
  `refer` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO websites VALUES("1","http://www.google.com","Google");
INSERT INTO websites VALUES("2","http://causelists.nic.in/madurai/index1.html","HC-LIST");



