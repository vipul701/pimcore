<?php
/**
 * Pimcore
 *
 * This source file is available under two different licenses:
 * - GNU General Public License version 3 (GPLv3)
 * - Pimcore Enterprise License (PEL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 * @copyright  Copyright (c) 2009-2016 pimcore GmbH (http://www.pimcore.org)
 * @license    http://www.pimcore.org/license     GPLv3 and PEL
 */

use Pimcore\Model\Object;
use Pimcore\Model\Document;

// determines if we're in Pimcore\Console mode
$pimcoreConsole = (defined('PIMCORE_CONSOLE') && true === PIMCORE_CONSOLE);

$workingDirectory = getcwd();
chdir(__DIR__);
include_once("../config/startup.php");
chdir($workingDirectory);

// CLI \Zend_Controller_Front Setup, this is required to make it possible to make use of all rendering features
// this includes $this->action() in templates, ...
$front = \Zend_Controller_Front::getInstance();
Pimcore::initControllerFront($front);

$request = new \Zend_Controller_Request_Http();
$request->setModuleName(PIMCORE_FRONTEND_MODULE);
$request->setControllerName("default");
$request->setActionName("default");
$front->setRequest($request);
$front->setResponse(new \Zend_Controller_Response_Cli());

//Activate Inheritance for cli-scripts
\Pimcore::unsetAdminMode();
Document::setHideUnpublished(true);
Object\AbstractObject::setHideUnpublished(true);
Object\AbstractObject::setGetInheritedValues(true);
Object\Localizedfield::setGetFallbackValues(true);


       
		// Start of Code to Generate XML for sally Beauty Products
		
	    $objList = new Object\SallyProduct\Listing();
		
		$objList->setUnpublished(true);
		$objList->load();
		
		$writer=new XMLWriter();
		$writer->openURI(test);
	
		$writer->startDocument('1.0','UTF-8');
		$writer->setIndent(4);
		$writer->startElement('catalog');
		$writer->writeAttribute('catalog-id', 'Sally_MasterCatalog');
		$writer->writeAttribute('xmlns','http://www.demandware.com/xml/impex/catalog/2006-10-31');
		
		//Header  image-settings internal-location view-types
		$writer->startElement('header');
		$writer->startElement('image-settings');
		$writer->startElement('internal-location');
		$writer->writeAttribute('base-path','/images');
	    $writer->endElement();
		$writer->startElement('view-types');
		$writer->startElement('view-type');
		$writer->text("large");
	    $writer->endElement();
		$writer->startElement('view-type');
		$writer->text("medium");
	    $writer->endElement();
		$writer->startElement('view-type');
		$writer->text("large");
	    $writer->endElement();
		$writer->startElement('view-type');
		$writer->text("swatch");
	    $writer->endElement();$writer->startElement('view-type');
		$writer->text("hi-res");
	    $writer->endElement();$writer->startElement('view-type');
		$writer->text("badge");
	    $writer->endElement();
	    
		$writer->endElement();
		//end of view types variation-attribute-id alt-pattern
		$writer->startElement('variation-attribute-id');
		$writer->text("color");
		$writer->endElement();
		
		$writer->startElement('alt-pattern');
		$writer->text("\${productname}, \${variationvalue}, \${viewtype}");
		$writer->endElement();
		
		$writer->startElement('title-pattern');
		$writer->text("\${productname}, \${variationvalue}, \${viewtype}");
		$writer->endElement();
		
		
		$writer->endElement();
		$writer->endElement();
		
		// Staring of Product Tags
		foreach ($objList as $obj) {
		
	        $temp = new ArrayObject();
			$temp = $obj->getVariants();
			
			if($temp!=null)
		{
		    $masterId=$obj->getMaster_Id();
	        if($masterId!=null){
		    $writer->startElement('product');
		    $writer->writeAttribute('product-id',$masterId);
		
		$writer->startElement('ean');
		$writer->endElement();
		
		
		$name=$obj->getName_es();
		if($name!=null)
		{
		$writer->startElement('display-name');
		$writer->writeAttribute('xml:lang','x-default');
		$writer->text($name);
		$writer->endElement();
		}
		
		if($name!=null){
		$writer->startElement('display-name');
		$writer->writeAttribute('xml:lang','es-MX');
		$writer->text($name);
		$writer->endElement();
		
		}
		$longDescription=$obj->getLongDescription_es();
		if($longDescription!=null){
		$writer->startElement('long-description');
		$writer->writeAttribute('xml:lang','x-default');
		$writer->text($longDescription);
		$writer->endElement();
		}
		
		 
		if($longDescription!=null){
		$writer->startElement('long-description');
		$writer->writeAttribute('xml:lang','x-default');
		$writer->text($longDescription);
		$writer->endElement();
		}
		
		 $online=$obj->getOnline();
		  if($online!=null){
		$writer->startElement('online-flag');
		$writer->text("true");
		$writer->endElement();
		}
		else 
	     {
		         foreach ($temp as $ob){
                 if($ob->getOnline()=='TRUE'){
				 $writer->startElement('online-flag');
		         $writer->text("true");
		         $writer->endElement();
				 break;
				 }
				 
			 }
		  }
		
		  $searchable=$obj->getSearchable();
		 if($searchable!=null){
		$writer->startElement('searchable-flag');
		$writer->text("true");
		$writer->endElement();
		}
		else 
		{ 
		    foreach ($temp as $ob){
                 if($ob->getSearchable()=='TRUE'){
				 $writer->startElement('searchable-flag');
		         $writer->text("true");
		         $writer->endElement();
				 break;
				 }
		   }
		}
		
		//start of Image Attributes
		$primaryImage=$obj->getPrimaryImage();
		$swatchImage=$obj->getSwatchImage();
		$badgeImage=$obj->getBadgeImage();
		$color=$obj->getColorName();
		if(($primaryImage!=null) or ($swatchImage!=null) or ($badgeImage!=null))
		{
		
		
		$writer->startElement('images');
	    //
		if($primaryImage!=null){
		$writer->startElement('image-group');
		$writer->writeAttribute('view-type','hi-res');
		
		
		if($color!=null){
		$writer->startElement('variation');
		$writer->writeAttribute('attribute-id','color');
		$writer->writeAttribute('value',$color);
		$writer->endElement();
		}
		$writer->startElement('image');
		;
		$writer->writeAttribute('path',"hi-res/$primaryImage");
		$writer->endElement();
		$writer->endElement();
		}
		//
		if($swatchImage!=null){
		$writer->startElement('image-group');
		$writer->writeAttribute('view-type','swatch');
		
		if($color!=null){
		$writer->startElement('variation');
		$writer->writeAttribute('attribute-id','color');
		$writer->writeAttribute('value',$color);
		$writer->endElement();
		}
		$writer->startElement('image');
		
		$writer->writeAttribute('path',"hi-res/$swatchImage");
		$writer->endElement();
		$writer->endElement();
		}
		//
		if($badgeImage!=null){
		$writer->startElement('image-group');
		$writer->writeAttribute('view-type','badge');
		if($color!=null){
		$writer->startElement('variation');
		$writer->writeAttribute('attribute-id','color');
		$writer->writeAttribute('value',$color);
		$writer->endElement();
		}
		$writer->startElement('image');
		
		$writer->writeAttribute('path',"hi-res/$badgeImage");
		$writer->endElement();
		$writer->endElement();
		}
		
		
		//Variants Objects Images
	      	foreach ($temp as $ob){
			
			$primaryImage=$ob->getPrimaryImage();
		    $swatchImage=$ob->getSwatchImage();
		    $badgeImage=$ob->getBadgeImage();
		    $color=$ob->getColorName();
		
		  if($primaryImage!=null){
		$writer->startElement('image-group');
		$writer->writeAttribute('view-type','hi-res');
		
		if($color!=null){
		$writer->startElement('variation');
		$writer->writeAttribute('attribute-id','color');
		$writer->writeAttribute('value',$color);
		$writer->endElement();
		}
		$writer->startElement('image');
		
		$writer->writeAttribute('path',"hi-res/$primaryImage");
		$writer->endElement();
		$writer->endElement();
		}
		//
		if($swatchImage!=null){
		$writer->startElement('image-group');
		$writer->writeAttribute('view-type','swatch');
		
		if($color!=null){
		$writer->startElement('variation');
		$writer->writeAttribute('attribute-id','color');
		$writer->writeAttribute('value',$color);
		$writer->endElement();
		}
		$writer->startElement('image');
		
		$writer->writeAttribute('path',"hi-res/$swatchImage");
		$writer->endElement();
		$writer->endElement();
		}
		//
		if($badgeImage!=null){
		$writer->startElement('image-group');
		$writer->writeAttribute('view-type','badge');
		if($color!=null){
		$writer->startElement('variation');
		$writer->writeAttribute('attribute-id','color');
		$writer->writeAttribute('value',$color);
		$writer->endElement();
		}
		$writer->startElement('image');
		
		$writer->writeAttribute('path',"hi-res/$badgeImage");
		$writer->endElement();
		$writer->endElement();
		}
     }
		// end of variant Images
		
		
		
		
		
		$writer->endElement();
		}
		//End of Image Attributes
		
		$searchRank=$obj->getSearchRank();
		if($searchRank!=null){
		$writer->startElement('search-rank');
		$writer->text($searchRank);
		$writer->endElement();
		}
		
		//start of page attributes
		$pageTitle=$obj->getPageTitle_es();
		$pageDescription=$obj->getPageDescription_es();
		$pageKeywords=$obj->getPageKeywords_es();
		if(($pageTitle!=null)or($pageDescription!=null)or ($pageKeywords!=null) ){
		$writer->startElement('page-attributes');
		
		if($pageTitle!=null){
		$writer->startElement('page-title');
		$writer->text($pageTitle);
		$writer->endElement();
		}
		if($pageDescription!=null){
		$writer->startElement('page-description');
		$writer->text($pageDescription);
		$writer->endElement();
		}
		if($pageKeywords!=null){
		$writer->startElement('page-keywords');
		$writer->text($pageKeywords);
		$writer->endElement();
		}
		
		$writer->endElement();
		}
		// end of page attributes
		
		//start of custom attributes
		
		$writer->startElement('custom-attributes');
		
		$arbitraryCategoryid1=$obj->getArbitraryCategoryid1();
		if($arbitraryCategoryid1!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','ArbitraryCategoryid1');
		$writer->text($arbitraryCategoryid1);
		$writer->endElement();
		}
		$arbitraryCategoryid2=$obj->getArbitraryCategoryid2();
		if($arbitraryCategoryid2!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','ArbitraryCategoryid2');
		$writer->text($arbitraryCategoryid2);
		$writer->endElement();
		}
		$arbitraryCategoryid3=$obj->getArbitraryCategoryid3();
		if($arbitraryCategoryid3!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','ArbitraryCategoryid3');
		$writer->text($arbitraryCategoryid3);
		$writer->endElement();
		}
		
		$importIndicator=$obj->getImportIndicator();
		if($importIndicator!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','ImportIndicator');
		$writer->text($importIndicator);
		$writer->endElement();
		}
		$productLoyaltyPointPrices=$obj->getProductLoyaltyPointPrices();
		if($productLoyaltyPointPrices!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','productLoyaltyPointPrices');
		$writer->text($productLoyaltyPointPrices);
		$writer->endElement();
		}
		$ingredients=$obj->getIngredients();
		if($ingredients!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','ingredients');
		$writer->text($ingredients);
		$writer->endElement();
		}
		$productStatus=$obj->getProductStatus();
		if($productStatus!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','productStatus');
		$writer->text($productStatus);
		$writer->endElement();
		}
		$size=$obj->getSize();
		if($size!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','size');
		$writer->text($size);
		$writer->endElement();
		}
		$content=$obj->getContent();
		if($content!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','content');
		$writer->text($content);
		$writer->endElement();
		}
		
		$width=$obj->getWidth();
		
		if($width!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','width');
		$writer->text($width);
		$writer->endElement();
		}
		
		$length=$obj->getLength();
		if($length!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','length');
		$writer->text($length);
		$writer->endElement();
		}
		$height=$obj->getHeight();
		if($height!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','height');
		$writer->text($height);
		$writer->endElement();
		}
		
		$weight=$obj->getWeight();
		if($weight!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','weight');
		$writer->text($weight);
		$writer->endElement();
		}
		$oferta=$obj->getOferta();
		if($oferta!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','oferta');
		$writer->text($oferta);
		$writer->endElement();
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','tag');
		$writer->text("oferta");
		$writer->endElement();
		}
		
		$exclusivoOnline=$obj->getExclusivoOnline();
		if($exclusivoOnline!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','exclusivoOnline');
		$writer->text($exclusivoOnline);
		$writer->endElement();
		}
		
		$nuevo=$obj->getNuevo();
		if($nuevo!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','nuevo');
		$writer->text($nuevo);
		$writer->endElement();
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','tag');
		$writer->text("nuevo");
		$writer->endElement();
		}
		
		$vegano=$obj->getVegano();
		if($vegano!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','vegano');
		$writer->text($vegano);
		$writer->endElement();
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','tag');
		$writer->text("vegano");
		$writer->endElement();
		}
		
		$koreano=$obj->getKoreano();
		if($koreano!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','Koreano');
		$writer->text($koreano);
		$writer->endElement();
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','tag');
		$writer->text("Koreano");
		$writer->endElement();
		}
		
		$hombre=$obj->getHombre();
		if($hombre!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','hombre');
		$writer->text($hombre);
		$writer->endElement();
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','tag');
		$writer->text("hombre");
		$writer->endElement();
		}
		
		$isPedmintoMarked=$obj->getIsPedmintoMarked();
		if($isPedmintoMarked!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','isPedmintoMarked');
		$writer->text($isPedmintoMarked);
		$writer->endElement();
		}
		
		$limitedAvailability=$obj->getLimitedAvailability();
		if($limitedAvailability!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','LimitedAvailability');
		$writer->text($limitedAvailability);
		$writer->endElement();
		}
		
		$IsGiftWrapProduct=$obj->getIsGiftWrapProduct();
		if($IsGiftWrapProduct!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','isGiftWrapProduct');
		$writer->text($IsGiftWrapProduct);
		$writer->endElement();
		}
		
		$isGiftWrapAllowed=$obj->getIsGiftWrapAllowed();
		if($isGiftWrapAllowed!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','isGiftWrapAllowed');
		$writer->text($isGiftWrapAllowed);
		$writer->endElement();
		}
	    $writer->endElement();
		//end of custom attributes
	    
		//start of variation
		$writer->startElement('variations');
		$writer->startElement('attributes');
		
		// code for printing variants of product
		$sizeFlag=false;
		foreach ($temp as $ob){
		if($ob->getSize()!=null){
		  $sizeFlag=true;
		  break;
		}
		}			
			  
		$colorFlag=false;
        foreach ($temp as $ob){
		
		  if($ob->getColor()!=null)
		  {
		     $colorFlag=true;
			 break;
		  }
	    }
		
		
		
		if($sizeFlag==true){
		$writer->startElement('variation-attribute');
		$writer->writeAttribute('attribute-id','size');
		$writer->writeAttribute('variation-attribute-id','size');
		$writer->startElement('display-name');
		$writer->writeAttribute('xml:lang','x-default');
		$writer->text("size");
		$writer->endElement();
		$writer->startElement('variation-attribute-values');
		foreach ($temp as $ob){
		
		     $sizeVariantProduct=$ob->getSize();
		 if($sizeVariantProduct!=null){
	
		
		
		$writer->startElement('variation-attribute-value');
		$writer->writeAttribute('value',$sizeVariantProduct);
		$writer->startElement('display-value');
		$writer->writeAttribute('xml:lang','x-default');
		$writer->text($sizeVariantProduct);
		$writer->endElement();
		$writer->endElement();
		
		
		}
		
		
		}
		$writer->endElement();
		$writer->endElement();
		
		
		}
		if($colorFlag==true){
		$writer->startElement('variation-attribute');
		$writer->writeAttribute('attribute-id','color');
		$writer->writeAttribute('variation-attribute-id','color');
		$writer->startElement('display-name');
		$writer->writeAttribute('xml:lang','x-default');
		$writer->text("color");
		$writer->endElement();
		$writer->startElement('variation-attribute-values');
		foreach ($temp as $ob){
		
		  $variantColor=$ob->getColorName();
		 if($variantColor!=null){
		
		
		
		$writer->startElement('variation-attribute-value');
		$writer->writeAttribute('value',$variantColor);
		$writer->startElement('display-value');
		$writer->writeAttribute('xml:lang','x-default');
		$writer->text($variantColor);
		$writer->endElement();
		$writer->endElement();
		
		}
		
		
		}
		$writer->endElement();
		$writer->endElement();
		
		}
		
		
		
		
		
        
		
		
		
		
		$writer->endElement();
		$writer->startElement('variants');
		foreach ($temp as $ob){
		
		  $variantId=$ob->getIDE();
		 if($variantId!=null){
		$writer->startElement('variant');
		$writer->writeAttribute('product-id',$variantId);
		$writer->endElement();
		}
		
		}
		$writer->endElement();
		$writer->endElement();
	    //end of variation
		
		
		$writer->startElement('classification-category');
		$writer->text($obj->getClassificationCategoryID());
		$writer->endElement();
		
		//Hello the last line is close for Product
		$writer->endElement();
		
			 
	    }
			 
			 
	  }
			 
		 else 
	     {
			     
	        if($obj->getMaster_Id()!=null)
			{
		    $writer->startElement('product');
			if($obj->getIDE()!=null)
			     {
			       $writer->writeAttribute('product-id',$obj->getIDE());
			     }
			else
			    {
			       $writer->writeAttribute('product-id',$obj->getMaster_Id());
			    }
			
		    
		
		$writer->startElement('ean');
		$writer->endElement();
		
		$name=$obj->getName_es();
		if($name!=null)
		{
		$writer->startElement('display-name');
		$writer->writeAttribute('xml:lang','x-default');
		$writer->text($name);
		$writer->endElement();
		}
		
		if($name!=null){
		$writer->startElement('display-name');
		$writer->writeAttribute('xml:lang','es-MX');
		$writer->text($name);
		$writer->endElement();
		
		}
		
		$longDescription=$obj->getLongDescription_es();
		if($longDescription!=null){
		$writer->startElement('long-description');
		$writer->writeAttribute('xml:lang','x-default');
		$writer->text($longDescription);
		$writer->endElement();
		}
		if($longDescription!=null){
		$writer->startElement('long-description');
		$writer->writeAttribute('xml:lang','x-default');
		$writer->text($longDescription);
		$writer->endElement();
		}
		
		 $online=$obj->getOnline();
		  if($online!=null){
		$writer->startElement('online-flag');
		$writer->text("true");
		$writer->endElement();
		}
		
		$searchable=$obj->getSearchable();
		 if($searchable!=null){
		$writer->startElement('searchable-flag');
		$writer->text("true");
		$writer->endElement();
		}
		
		//start of Image Attributes
		$primaryImage=$obj->getPrimaryImage();
		$swatchImage=$obj->getSwatchImage();
		$badgeImage=$obj->getBadgeImage();
		$color=$obj->getColorName();
		if(($primaryImage!=null) or ($swatchImage!=null) or ($badgeImage!=null))
		{
		
		
		$writer->startElement('images');
	    //
		if($primaryImage!=null){
		$writer->startElement('image-group');
		$writer->writeAttribute('view-type','hi-res');
		
		
		if($color!=null){
		$writer->startElement('variation');
		$writer->writeAttribute('attribute-id','color');
		$writer->writeAttribute('value',$color);
		$writer->endElement();
		}
		$writer->startElement('image');
		;
		$writer->writeAttribute('path',"hi-res/$primaryImage");
		$writer->endElement();
		$writer->endElement();
		}
		//
		if($swatchImage!=null){
		$writer->startElement('image-group');
		$writer->writeAttribute('view-type','swatch');
		
		if($color!=null){
		$writer->startElement('variation');
		$writer->writeAttribute('attribute-id','color');
		$writer->writeAttribute('value',$color);
		$writer->endElement();
		}
		$writer->startElement('image');
		
		$writer->writeAttribute('path',"hi-res/$swatchImage");
		$writer->endElement();
		$writer->endElement();
		}
		//
		if($badgeImage!=null){
		$writer->startElement('image-group');
		$writer->writeAttribute('view-type','badge');
		if($color!=null){
		$writer->startElement('variation');
		$writer->writeAttribute('attribute-id','color');
		$writer->writeAttribute('value',$color);
		$writer->endElement();
		}
		$writer->startElement('image');
		
		$writer->writeAttribute('path',"hi-res/$badgeImage");
		$writer->endElement();
		$writer->endElement();
		}
		
		$writer->endElement();
		}
		//End of Image Attributes
		
		$searchRank=$obj->getSearchRank();
		if($searchRank!=null){
		$writer->startElement('search-rank');
		$writer->text($searchRank);
		$writer->endElement();
		}
		
		//start of page attributes
		$pageTitle=$obj->getPageTitle_es();
		$pageDescription=$obj->getPageDescription_es();
		$pageKeywords=$obj->getPageKeywords_es();
		if(($pageTitle!=null)or($pageDescription!=null)or ($pageKeywords!=null) ){
		$writer->startElement('page-attributes');
		
		if($pageTitle!=null){
		$writer->startElement('page-title');
		$writer->text($pageTitle);
		$writer->endElement();
		}
		if($pageDescription!=null){
		$writer->startElement('page-description');
		$writer->text($pageDescription);
		$writer->endElement();
		}
		if($pageKeywords!=null){
		$writer->startElement('page-keywords');
		$writer->text($pageKeywords);
		$writer->endElement();
		}
		
		$writer->endElement();
		}
		
	
		// end of page attributes
		
		//start of custom attributes
		
		$writer->startElement('custom-attributes');
		
		$arbitraryCategoryid1=$obj->getArbitraryCategoryid1();
		if($arbitraryCategoryid1!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','ArbitraryCategoryid1');
		$writer->text($arbitraryCategoryid1);
		$writer->endElement();
		}
		$arbitraryCategoryid2=$obj->getArbitraryCategoryid2();
		if($arbitraryCategoryid2!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','ArbitraryCategoryid2');
		$writer->text($arbitraryCategoryid2);
		$writer->endElement();
		}
		$arbitraryCategoryid3=$obj->getArbitraryCategoryid3();
		if($arbitraryCategoryid3!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','ArbitraryCategoryid3');
		$writer->text($arbitraryCategoryid3);
		$writer->endElement();
		}
		
		$importIndicator=$obj->getImportIndicator();
		if($importIndicator!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','ImportIndicator');
		$writer->text($importIndicator);
		$writer->endElement();
		}
		$productLoyaltyPointPrices=$obj->getProductLoyaltyPointPrices();
		if($productLoyaltyPointPrices!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','productLoyaltyPointPrices');
		$writer->text($productLoyaltyPointPrices);
		$writer->endElement();
		}
		$ingredients=$obj->getIngredients();
		if($ingredients!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','ingredients');
		$writer->text($ingredients);
		$writer->endElement();
		}
		$productStatus=$obj->getProductStatus();
		if($productStatus!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','productStatus');
		$writer->text($productStatus);
		$writer->endElement();
		}
		$size=$obj->getSize();
		if($size!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','size');
		$writer->text($size);
		$writer->endElement();
		}
		$content=$obj->getContent();
		if($content!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','content');
		$writer->text($content);
		$writer->endElement();
		}
		
		$width=$obj->getWidth();
		
		if($width!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','width');
		$writer->text($width);
		$writer->endElement();
		}
		
		$length=$obj->getLength();
		if($length!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','length');
		$writer->text($length);
		$writer->endElement();
		}
		$height=$obj->getHeight();
		if($height!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','height');
		$writer->text($height);
		$writer->endElement();
		}
		
		$weight=$obj->getWeight();
		if($weight!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','weight');
		$writer->text($weight);
		$writer->endElement();
		}
		$oferta=$obj->getOferta();
		if($oferta!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','oferta');
		$writer->text($oferta);
		$writer->endElement();
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','tag');
		$writer->text("oferta");
		$writer->endElement();
		}
		
		$exclusivoOnline=$obj->getExclusivoOnline();
		if($exclusivoOnline!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','exclusivoOnline');
		$writer->text($exclusivoOnline);
		$writer->endElement();
		}
		
		$nuevo=$obj->getNuevo();
		if($nuevo!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','nuevo');
		$writer->text($nuevo);
		$writer->endElement();
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','tag');
		$writer->text("nuevo");
		$writer->endElement();
		}
		
		$vegano=$obj->getVegano();
		if($vegano!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','vegano');
		$writer->text($vegano);
		$writer->endElement();
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','tag');
		$writer->text("vegano");
		$writer->endElement();
		}
		
		$koreano=$obj->getKoreano();
		if($koreano!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','Koreano');
		$writer->text($koreano);
		$writer->endElement();
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','tag');
		$writer->text("Koreano");
		$writer->endElement();
		}
		
		$hombre=$obj->getHombre();
		if($hombre!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','hombre');
		$writer->text($hombre);
		$writer->endElement();
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','tag');
		$writer->text("hombre");
		$writer->endElement();
		}
		
		$isPedmintoMarked=$obj->getIsPedmintoMarked();
		if($isPedmintoMarked!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','isPedmintoMarked');
		$writer->text($isPedmintoMarked);
		$writer->endElement();
		}
		
		$limitedAvailability=$obj->getLimitedAvailability();
		if($limitedAvailability!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','LimitedAvailability');
		$writer->text($limitedAvailability);
		$writer->endElement();
		}
		
		$IsGiftWrapProduct=$obj->getIsGiftWrapProduct();
		if($IsGiftWrapProduct!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','isGiftWrapProduct');
		$writer->text($IsGiftWrapProduct);
		$writer->endElement();
		}
		
		$isGiftWrapAllowed=$obj->getIsGiftWrapAllowed();
		if($isGiftWrapAllowed!=null){
		$writer->startElement('custom-attribute');
		$writer->writeAttribute('attribute-id','isGiftWrapAllowed');
		$writer->text($isGiftWrapAllowed);
		$writer->endElement();
		}
	    $writer->endElement();
		//end of custom attributes
		
	    
		//start of variation
		$color=$obj->getColorName();
		$size=$obj->getSize();
		
		if(($size!=null)or($color!=null))
		{
		
		$writer->startElement('variations');
		$writer->startElement('attributes');
		
		if($size!=null){
		$writer->startElement('variation-attribute');
		$writer->writeAttribute('attribute-id','size');
		$writer->writeAttribute('variation-attribute-id','size');
		$writer->startElement('display-name');
		$writer->writeAttribute('xml:lang','x-default');
		$writer->text("size");
		$writer->endElement();
		$writer->startElement('variation-attribute-values');
		
		$writer->startElement('variation-attribute-value');
		$writer->writeAttribute('value',$size);
		$writer->startElement('display-value');
		$writer->writeAttribute('xml:lang','x-default');
		$writer->text($size);
		$writer->endElement();
		$writer->endElement();
		
		
		
		$writer->endElement();
		$writer->endElement();
		}
		if($color!=null){
		$writer->startElement('variation-attribute');
		$writer->writeAttribute('attribute-id','color');
		$writer->writeAttribute('variation-attribute-id','color');
		$writer->startElement('display-name');
		$writer->writeAttribute('xml:lang','x-default');
		$writer->text("color");
		$writer->endElement();
		$writer->startElement('variation-attribute-values');
		
		$writer->startElement('variation-attribute-value');
		$writer->writeAttribute('value',$color);
		$writer->startElement('display-value');
		$writer->writeAttribute('xml:lang','x-default');
		$writer->text($color);
		$writer->endElement();
		$writer->endElement();
		
		
		
		$writer->endElement();
		$writer->endElement();
		}
		
		
		
		

		$writer->endElement(); // end of attributes tag
		$writer->startElement('variants');
		$writer->endElement();
		$writer->endElement();
		}
	    //end of variation
		
		$writer->startElement('classification-category');
		$writer->text($obj->getClassificationCategoryID());
		$writer->endElement();
		
		//Hello the last line is close for Product
		$writer->endElement();
        }
	  }     // close else Condition
			 
			 
			 
			 
	   }
     $writer->endElement();
	 $writer->endDocument();
	 $writer->flush();
	 $xml = simplexml_load_file('test');
	 $dom = new DOMDocument('1.0');
     $dom->preserveWhiteSpace = false; 
     $dom->formatOutput = true; 
     $dom->loadXML($xml->asXML()); 
     echo $dom->saveXML();
     $dom->save("sallyExport.xml");
		
	    // End of Code for Generation of XML of sally Beauty Products.
		
		
		
		
     

	 
	 
// CLI has no memory/time limits
@ini_set('memory_limit', -1);
@ini_set('max_execution_time', -1);
@ini_set('max_input_time', -1);

// Error reporting is enabled in CLI
@ini_set("display_errors", "On");
@ini_set("display_startup_errors", "On");
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT);

// Pimcore\Console handles maintenance mode through the AbstractCommand
if (!$pimcoreConsole) {
    // skip if maintenance mode is on and the flag is not set
    // we cannot use \Zend_Console_Getopt here because it doesn't allow to be called twice (unrecognized parameter, ...)
    if (\Pimcore\Tool\Admin::isInMaintenanceMode() && !in_array("--ignore-maintenance-mode", $_SERVER['argv'])) {
        die("in maintenance mode -> skip\nset the flag --ignore-maintenance-mode to force execution \n");
    }
}
