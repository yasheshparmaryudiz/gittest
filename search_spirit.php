<!--******************* Banner Section Start ******************-->
    <section class="banner inner-banner spirit-banner">
        <div class="banner-desc">
            <h1>Spirits<br><span>For Those Who <strong>Know</strong> the Best</span></h1>
        </div>
    </section>
    <!--******************* Banner Section End ******************-->
    <!--******************* Middle Section Start ******************-->
    <main>
        <?php $this->load->view('front/_spirit_search_panel');?>
        <section class="content-section section-bg1">
            <div class="container">
                <!-- <div class="stroke-title">
                    <p>What is your favorite - do you have a preference?</p>
                </div> -->
               <div class="section-title">
                <h3>SPIRIT DATABASE</h3>
            </div>
                <div class="spirit-filter-block">
                    <div class="filter-bar">
                        <div class="row">
<!--                             <div class="col-xs-8"> -->
<!--                                 <span>Show Items</span> -->
<!--                                 <div class="input-group spinner"> -->
<!--                                     <input type="text" class="form-control" value="9"> -->
<!--                                     <div class="input-group-btn-vertical"> -->
<!--                                       <button class="btn btn-default" type="button"><i class="fa fa-angle-up" aria-hidden="true"></i></button> -->
<!--                                       <button class="btn btn-default" type="button"><i class="fa fa-angle-down" aria-hidden="true"></i></button> -->
<!--                                     </div> -->
<!--                                 </div> -->
<!--                             </div> -->
<!--                             <div class="col-xs-4 paddingl-none"> -->
<!--                                 <ul class="filter-grid list-inline navbar-right"> -->
<!--                                     <li><a href="#"><i class="fa fa-th" aria-hidden="true"></i></a></li> -->
<!--                                     <li><a href="#"><i class="fa fa-th-list" aria-hidden="true"></i></a></li> -->
<!--                                 </ul> -->
<!--                             </div> -->
<!--                             <div class="clearfix"></div> -->
                        </div>
                    </div>
                    <div class="spirit-filter-content">
                        <div class="row">
                            <?php
                            foreach ($spirits as $spirit)
                            {
                            	$favourite_class="";
                            	if(!empty($spirit['vType']))
                            	{
                            		$favourite_class	=	"mark-as-favorait";
                            	}

                            	?>
	                            <div class="col-sm-4">
	                                <a href="spirits/product_detail/<?php echo $spirit['spirit_id']?>" class="spirit-box j_query_spirit_box <?php echo $favourite_class;?>">
	                                <!--<a class="spirit-box <?php echo $favourite_class;?>" id="beer_id_<?php echo $spirit['spirit_id']?>">-->
	                                    <div class="product-thumb">
	                                        <figure>
	                                            <img src="http://ping2world.com/designing/wordpress/oh-spirits/themes/front/images/single-product.png" alt="spirit product" />
	                                        </figure>
	                                    </div>
	                                    <ul class="product-desc">
	                                        <li><?php
	                                        echo (empty($spirit['vName']))?"<br>":substr($spirit['vName'], 0,30);
	                                        echo (strlen($spirit['vName'])>30)?"...":"";
	                                        //echo $spirit['vName'];
	                                        ?></li>
	                                        <li><span class="star-rated"><?php echo $spirit['fStarRating'];?></span><span class="date-rated"><?php echo date("d M, Y",strtotime($spirit['dCreatedDate']))//dCreatedAt?></span></li>
	                                        <li><?php echo $spirit['vBrandMaker'];?></li>
	                                    </ul>
	                                    <div class="favoraite-mark click_fm" id="<?php echo $spirit['spirit_id']?>" onClick="">
	                                        <i class="fa fa-heart" aria-hidden="true"></i>
	                                    </div>
	                                </a>
	                            </div>
                            	<?php
                            }

                            if(count($spirits)==0)
                            {
                            	?>
                            	<div class="col-sm-4">
                            	No product found for this search.
	                            </div>
                            	<?php
                            }
                            ?>
							<div class="col-sm-12"> <?php echo $links; ?></div>
                    </div>
                </div>

                <script type="text/javascript">

				<?php
				if ($isUserLogin=="yes")
				{
					?>

				       $('.click_fm').click(function(event){
				    	   add_to_favourite('<?php echo $this->sessUserId ?>',$(this).attr('id'),'spirit');
				    	   /*$(this).parent('a').toggleClass("mark-as-favorait");*/
				    	   event.preventDefault();
				    	   //alert('test');
				    	   return false;
					   });

					<?php
				}
				else
				{
				?>
				$('.click_fm').click(function(event){
			    	   event.preventDefault();
			    	   add_to_favourite('',$(this).attr('id'),'spirit');
			    	   //alert('test');
			    	   return false;
				   });

					<?php
				}
				?>


                function add_to_favourite(userid,productid,type)
                {
                    if(userid=="")
                    {
                        /* alert("Please login to add to favourite."); */
                        show_login_popup();
                    }
                    else
                    {
	                	$.ajax({
	                	  method: "GET",
	                	  url: "<?php echo base_url('spirits/add_to_favourite')?>",
	                	  data: { userid: userid, productid: productid,type:type },
	                	  format: "json",
	                	  success: function(result){
		                	  console.log("result : "+result);
		                	  if(result!="max_reached")
		                	  {
		                	  	$("#"+productid).parent('a').toggleClass("mark-as-favorait");
		                	  }
		                	  else
		                	  {
		                	  		/*alert("You already have added 5 favourite spirits.");*/
		                		  Custom.myNotification("Error","You already have added 5 favourite spirits.");
		                	  }
	                	    }
	                	});
                    }
                }
               </script>



                <!--
                <div class="section-title-4">
                    <h2>our whisky</h2>
                </div>
                <div class="filter-bar"></div>
                <div class="row">
                    <div class="col-sm-4">
                        <a href="spirit-detail.html" class="spirit-box">
                            <div class="product-thumb">
                                <figure>
                                    <img src="http://ping2world.com/designing/wordpress/oh-spirits/themes/front/images/whisky-product.png" alt="spirit product" />
                                </figure>
                            </div>
                            <ul class="product-desc">
                                <li>Magic Moment</li>
                                <li><span class="star-rated">4.5</span><span class="date-rated">25 June, 2011</span></li>
                                <li>Jonny Walker</li>
                            </ul>
                            <div class="favoraite-mark">
                                <i class="fa fa-heart" aria-hidden="true"></i>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4">
                        <a href="spirit-detail.html" class="spirit-box mark-as-favorait">
                            <div class="product-thumb">
                                <figure>
                                    <img src="http://ping2world.com/designing/wordpress/oh-spirits/themes/front/images/whisky-product.png" alt="spirit product" />
                                </figure>
                            </div>
                            <ul class="product-desc">
                                <li>Magic Moment</li>
                                <li><span class="star-rated">4.5</span><span class="date-rated">25 June, 2011</span></li>
                                <li>Jonny Walker</li>
                            </ul>
                            <div class="favoraite-mark ">
                                <i class="fa fa-heart" aria-hidden="true"></i>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4">
                        <a href="spirit-detail.html" class="spirit-box">
                            <div class="product-thumb">
                                <figure>
                                    <img src="http://ping2world.com/designing/wordpress/oh-spirits/themes/front/images/whisky-product.png" alt="spirit product" />
                                </figure>
                            </div>
                            <ul class="product-desc">
                                <li>Magic Moment</li>
                                <li><span class="star-rated">4.5</span><span class="date-rated">25 June, 2011</span></li>
                                <li>Jonny Walker</li>
                            </ul>
                            <div class="favoraite-mark">
                                <i class="fa fa-heart" aria-hidden="true"></i>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4">
                        <a href="spirit-detail.html" class="spirit-box">
                            <div class="product-thumb">
                                <figure>
                                    <img src="http://ping2world.com/designing/wordpress/oh-spirits/themes/front/images/whisky-product.png" alt="spirit product" />
                                </figure>
                            </div>
                            <ul class="product-desc">
                                <li>Magic Moment</li>
                                <li><span class="star-rated">4.5</span><span class="date-rated">25 June, 2011</span></li>
                                <li>Jonny Walker</li>
                            </ul>
                            <div class="favoraite-mark">
                                <i class="fa fa-heart" aria-hidden="true"></i>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4">
                        <a href="spirit-detail.html" class="spirit-box mark-as-favorait">
                            <div class="product-thumb">
                                <figure>
                                    <img src="http://ping2world.com/designing/wordpress/oh-spirits/themes/front/images/whisky-product.png" alt="spirit product" />
                                </figure>
                            </div>
                            <ul class="product-desc">
                                <li>Magic Moment</li>
                                <li><span class="star-rated">4.5</span><span class="date-rated">25 June, 2011</span></li>
                                <li>Jonny Walker</li>
                            </ul>
                            <div class="favoraite-mark ">
                                <i class="fa fa-heart" aria-hidden="true"></i>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4">
                        <a href="spirit-detail.html" class="spirit-box">
                            <div class="product-thumb">
                                <figure>
                                    <img src="http://ping2world.com/designing/wordpress/oh-spirits/themes/front/images/whisky-product.png" alt="spirit product" />
                                </figure>
                            </div>
                            <ul class="product-desc">
                                <li>Magic Moment</li>
                                <li><span class="star-rated">4.5</span><span class="date-rated">25 June, 2011</span></li>
                                <li>Jonny Walker</li>
                            </ul>
                            <div class="favoraite-mark">
                                <i class="fa fa-heart" aria-hidden="true"></i>
                            </div>
                        </a>
                    </div>
                </div>
                -->
            </div>
        </section>
    </main>
    <!--******************* Middle Section End ******************-->

    <style>


		ul.tsc_pagination { margin:4px 0; padding:0px; height:100%; overflow:hidden; font:12px 'Tahoma'; list-style-type:none; }
		ul.tsc_pagination li { float:left; margin:0px; padding:0px; margin-left:5px; }

		ul.tsc_pagination li a { color:black; display:block; text-decoration:none; padding:7px 10px 7px 10px; }


		ul.tsc_paginationA li a { color:#FFFFFF; border-radius:3px; -moz-border-radius:3px; -webkit-border-radius:3px; }

		ul.tsc_paginationA01 li a { color:#474747; border:solid 1px #B6B6B6; padding:6px 9px 6px 9px; background:#E6E6E6; background:-moz-linear-gradient(top, #FFFFFF 1px, #F3F3F3 1px, #E6E6E6); background:-webkit-gradient(linear, 0 0, 0 100%, color-stop(0.02, #FFFFFF), color-stop(0.02, #F3F3F3), color-stop(1, #E6E6E6)); }
		ul.tsc_paginationA01 li:hover a,
		ul.tsc_paginationA01 li.current a { background:#FFFFFF; }
		</style>