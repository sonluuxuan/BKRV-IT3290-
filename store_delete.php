<div class="col-md-4 featured-responsive" id="col_+cnt+">
	                    <div class="featured-place-wrap">
	                        <a href="detail.php">
	                            <img src="temp/featured2.jpg" class="img-fluid" alt="#">
	                            <span class="featured-rating-green">+data[i]['rating']+</span>
	                            <div class="featured-title-box">
	                                <h6>+data[i]['ten']+</h6>
	                                <p>+data[i]['loai']+</p> <span>• </span>
	                                <p><span>$$$</span>$$</p>
	                                <ul>
	                                    <li><span class="ti-location-pin"></span>
	                                        <p name="store_name">+data[i]['dia_chi']+</p>
	                                    </li>
	                                    <li><span class="fa fa-tag minmaxpriceicon"></span>
	                                        <p name="store_pricerange">+data[i]['low']+ - +data[i]['high']+</p>
	                                    </li>
	                                    <li><span class="ti-time"></span>
	                                        <p name="store_opening">+data[i]['time_low']+ - +data[i]['time_high']+</p>
	                                    </li>

	                                </ul>
	                                <div class="bottom-icons">
	                                    <div class="closed-now">CLOSED NOW</div>
	                                    <span class="ti-heart"><span class="upvote display-number" name="no_upvotes">+data[i]['likes']+</span></span>
	                                    <span class="ti-comments"><span class="comment display-number" name="no_comments">+data[i]['comments']+</span></span>
	                                </div>
	                            </div>
	                        </a>
	                    </div>
	                </div>
<script>
var large = '<div class="col-md-4 featured-responsive" id="col_'+cnt+'"><div class="featured-place-wrap"><a href="detail.php"><img src="temp/featured2.jpg" class="img-fluid" alt="#"><span class="featured-rating-green">'+data[i]['rating']+'</span><div class="featured-title-box"><h6>'+data[i]['ten']+'</h6><p>'+data[i]['loai']+'</p> <span>• </span><p><span>$$$</span>$$</p><ul><li><span class="ti-location-pin"></span><p name="store_name">'+data[i]['dia_chi']+'</p></li><li><span class="fa fa-tag minmaxpriceicon"></span><p name="store_pricerange">'+data[i]['low']+' - '+data[i]['high']+'</p></li><li><span class="ti-time"></span><p name="store_opening">'+data[i]['time_low']+' - '+data[i]['time_high']+'</p></li></ul><div class="bottom-icons"><div class="closed-now">CLOSED NOW</div><span class="ti-heart"><span class="upvote display-number" name="no_upvotes">'+data[i]['likes']+'</span></span><span class="ti-comments"><span class="comment display-number" name="no_comments">'+data[i]['comments']+'</span></span></div></div></a></div></div>';	                
</script>