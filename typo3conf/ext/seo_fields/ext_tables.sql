#
# Table structure for table 'pages'
#
CREATE TABLE pages (
        h2Headline varchar(255) DEFAULT '' NOT NULL,
        titleSuffixCheck tinyint(3) DEFAULT '0' NOT NULL
);

#
# Table structure for table 'pages_language_overlay'
#
CREATE TABLE pages_language_overlay (
        h2Headline varchar(255) DEFAULT '' NOT NULL,
        titleSuffixCheck tinyint(3) DEFAULT '0' NOT NULL
);

#
# Table structure for table 'tt_content'
#
CREATE TABLE tt_content (
	headerLinkText varchar(255) DEFAULT '' NOT NULL,
        headerLinkCheck tinyint(3) DEFAULT '0' NOT NULL,
        geoLatitude varchar(255) DEFAULT '' NOT NULL,
        geoLongtitude varchar(255) DEFAULT '' NOT NULL,
        tabHeadline varchar(255) NOT NULL,
        tabBodytext text NOT NULL,
        youtubeId varchar(255) NOT NULL
);
