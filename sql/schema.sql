--
-- Database: `import_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--
DROP TABLE categories;

CREATE TABLE `categories` (
`id` int(11) NOT NULL,
`categoryId` varchar(64),
`metaTitle` varchar(255),
`metaKeywords` varchar(255),
`metaDescription` varchar(255),
`categoryCZ` varchar(60),
`categoryName` varchar(60),
`URLKey` varchar(255),
`language` varchar(20),
`smallImage` varchar(255),
`image` varchar(255),
`description` TEXT(20000),
`summary` TEXT(10000)
);

-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


--
-- Database: `import_data`
--

-- --------------------------------------------------------
--
-- Table structure for table `brands`
--
DROP TABLE brands;

CREATE TABLE `brands` (
`id` int(11) NOT NULL,
`brandId` varchar(255),
`URLKey` varchar(255),
`metaKeywords` varchar(255),
`metaDescription` varchar(255),
`language` varchar(20),
`description` TEXT(20000),
`longDescription` TEXT(40000),
`longDescriptionTitle` varchar(60),
`summary` TEXT(10000),
`sortorder` int(11),
`smallImage` varchar(255),
`image` varchar(255),
`featuredBrand` varchar(10),
`master` varchar(10),
`storeView` varchar(10)
);

-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

