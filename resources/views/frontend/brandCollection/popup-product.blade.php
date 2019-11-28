<div class="p-product">
	<div class="p-product__center">
		<ul class="p-product__list owl-carousel js-p-slider">
		</ul>
		<div id="buyPopup" class="p-product__find-dealer">
			<where-buy></where-buy>
		</div>
	</div>
</div>

<script type="text/template" id="list-template">
	<% products.forEach(function(product) { %>
		<li class="p-product__product" data-id="<%- product.id %>">
			<div class="p-product__img">
				<img src="<%- product.img %>" alt="">
			</div>
			<div class="p-product__right">
				<a href="#" class="p-product__close js-close-p-product">
					<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
						<rect y="14.5454" width="20.5702" height="2.05702" transform="rotate(-45 0 14.5454)"/>
						<rect x="1.45459" width="20.5702" height="2.05702" transform="rotate(45 1.45459 0)"/>
					</svg>
				</a>
				<div class="p-product__top">
					<div class="p-product__line p-product__line--top">
						<h2 class="p-product__title"><%= product.name %></h2>
						<div class="p-product__price p-product__price--mobile df-lead-text-22px"><%= product.price %><sup>*</sup></div>
					</div>
					<div class="p-product__art df-text-small-12px">арт. <span><%= product.art %></span></div>
					<div class="p-product__price df-lead-text-22px"><%= product.price %><sup>*</sup></div>
					<div class="p-product__text">
						<%= product.description %>
					</div>
					<div class="p-product__line">
						<div class="p-product__description h6">Материал</div>
						<div class="p-product__value df-text-small-12px"><%= product.material %></div>
					</div>
					<div class="p-product__line">
						<div class="p-product__description h6">Размер (см)</div>
						<div class="p-product__value df-text-small-12px"><%= product.size %></div>
					</div>
					<div class="p-product__note df-text-small-12px">
						Приобрести и узнать о наличии товара вы можете у дилеров Hyundai
					</div>
					<div class="p-product__button df-button js-p-find-dealer">Найти дилера</div>
				</div>
				<div class="p-product__dsclmr df-text-small-12px">
					<div class="p-product__star">
						<svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M2.66411 7.31201L3.96011 5.31401L5.23811 7.31201L6.62411 6.32201L5.16611 4.54001L7.34411 3.96401L6.89411 2.32601L4.71611 3.11801L4.84211 0.76001H3.06011L3.20411 3.11801L1.00811 2.32601L0.558105 3.96401L2.73611 4.54001L1.27811 6.32201L2.66411 7.31201Z" fill="white"/>
						</svg>
					</div>
					Стоимость оригинальных аксессуаров носит исключительно ознакомительный характер и&nbsp;может отличаться от&nbsp;действующих цен в&nbsp;официальных дилерских центрах Hyundai.
				</div>
			</div>
		</li>
	<% }); %>
</script>