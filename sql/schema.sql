--
-- Database: `import_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `catalogo`
--

CREATE TABLE `catalogo` (
`id` int(11) NOT NULL,
`productId` varchar(64),
`store_view_code` varchar(30),
`attribute_set_code` varchar(20),
`product_type` varchar(30),
`product_kind` varchar(30),
`categories` varchar(80),
`product_websites` varchar(30),
`brand` varchar(64),
`name` varchar(64),
`description` TEXT(1024),
`short_description` varchar(255),
`weight` decimal,
`product_online` varchar(8),
`tax_class_name` varchar(255),
`visibility` varchar(30),
`price` decimal,
`special_price` decimal,
`special_price_from_date` date,
`special_price_to_date` date,
`url_key` varchar(100),
`meta_title` varchar(80),
`meta_keywords` varchar(80),
`meta_description` varchar(255),
`base_image` varchar(255),
`base_image_label` varchar(255),
`small_image` varchar(255),
`small_image_label` varchar(255),
`thumbnail_image` varchar(255),
`thumbnail_image_label` varchar(255),
`swatch_image` varchar(255),
`swatch_image_label` varchar(255),
`created_at` date,
`updated_at` date,
`new_from_date` date,
`new_to_date` date,
`display_product_options_in` varchar(30),
`map_price` decimal,
`msrp_price` decimal,
`map_enabled` varchar(4),
`gift_message_available` varchar(4),
`custom_design` varchar(255),
`custom_design_from` date,
`custom_design_to` date,
`custom_layout_update` varchar(30),
`page_layout` varchar(30),
`product_options_container` varchar(30),
`msrp_display_actual_price_type` varchar(30),
`market_type` varchar(64), --added
`manufacturer` varchar(64), --added
`country_of_manufacture` varchar(64),
`additional_attributes` varchar(255),
`qty` decimal,
`out_of_stock_qty` decimal,
`use_config_min_qty` decimal,
`is_qty_decimal` varchar(4),
`allow_backorders` varchar(4),
`use_config_backorders` varchar(4),
`min_cart_qty` decimal,
`use_config_min_sale_qty` decimal,
`max_cart_qty` decimal,
`use_config_max_sale_qty` varchar(4),
`is_in_stock`  varchar(4),
`notify_on_stock_below` decimal,
`use_config_notify_stock_qty` decimal,
`manage_stock` varchar(255),
`use_config_manage_stock`  varchar(255),
`use_config_qty_increments` decimal,
`qty_increments` varchar(4),
`use_config_enable_qty_inc` decimal,
`enable_qty_increments`          decimal,
`is_decimal_divided`  varchar(255),
`website_id` varchar(255),
`related_skus`  TEXT(1024),
`related_position` varchar(4),
`crosssell_skus` TEXT(1024),
`crosssell_position`  varchar(4),
`upsell_skus` TEXT(1024),
`upsell_position`  varchar(4), 
`additional_images` TEXT(1024),
`additional_image_labels` TEXT(1024),
`hide_from_product_page` varchar(4),
`custom_options` TEXT(1024),
`bundle_price_type`varchar(8),
`bundle_sku_type`  varchar(255),
`bundle_price_view` varchar(255),
`bundle_weight_type` varchar(255),
`bundle_values` TEXT(1024),
`bundle_shipment_type` varchar(255),
`associated_skus` varchar(255),
`configurable_variations` varchar(255),
`configurable_variation_labels` varchar(255),
`unit`  varchar(4), --added
`order_unit`  varchar(4), --added
);

-- Indexes for dumped tables
--

--
-- Indexes for table `catalogo`
--
ALTER TABLE `catalogo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catalogo`
--
ALTER TABLE `catalogo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
