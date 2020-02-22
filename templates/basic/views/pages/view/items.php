{% if items |length > 0 %}
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">                
		<h2 class="Conv_Circe-Bold mt10 pb30 px22"><span class="title_line px22" style="color:#62a9d5 !important; text-transform:uppercase;">Недавно просмотренные</span></h2>              
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">        
		<div class="single-slide">
		{% for item in items %} 
			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 catalog-xs">
				<div class="text_shad">
					<div class="p15">                
						<a href="{{item.orig.link}}" class=""><img src="/uploads/products/250/{{item.orig.image}}" alt="{{item.title}}" width="100%"></a>
		
						<a href="{{item.orig.link}}"><h4 class="clearfix title_h Conv_CRC55">{{item.title}}</h4></a>
		
						<span class="clearfix line_t clearfix">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
						<strong class="px20 clearfix">
							<small class="serebro_white px13" style="position:absolute; margin-top:-12px;"><s>{{ item.price }} р.</s></small> 
							{{ item.salePrice }} р.
						</strong>
		
					</div>
		
					<a href="#" class="btn-cart Conv_CRC55  btn-block text-center ZAG cart-anim" onclick="yaCounter45556173.reachGoal('cart-catalog');" click="CART.add({ id:{{item.id}}, title:'{{item.title}}', price:{{item.price}}, qty:{type:'plus', value:1}, orig: { image:'{{item.orig.image}}', articul:'{{item.orig.articul}}', link:'{{item.orig.link}}'}}, MAIN.addCartCallback );">В корзину</a>
				</div> 
			</div> 
		{% endfor %}
		</div> 
	</div> 
{% endif %}

<script>
	$('.single-slide').slick({
		dots: true,
		infinite: false,
		slidesToShow: 4,
		slidesToScroll: 1,
		responsive: [{
			breakpoint: 640,
			settings: {
				slidesToShow: 2
			}
		},{
			breakpoint: 380,
			settings: {
				slidesToShow: 2
			}
		}]
	}); 
</script>
