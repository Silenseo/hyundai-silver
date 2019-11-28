<?php
$limit = 7;
?>

@if($paginator->lastPage() > 1)
	<div class="df-pagination">
		@if($paginator->currentPage() != 1)
		<a href="{{ $paginator->url(1) }}" class="df-pagination__first">
			<svg aria-hidden="true">
				<use xlink:href="#icon-arrow_pagination"></use>
			</svg>
			<svg aria-hidden="true">
				<use xlink:href="#icon-arrow_pagination"></use>
			</svg>
		</a>
		<a href="{{ $paginator->previousPageUrl() }}" class="df-pagination__prev">
			<svg aria-hidden="true">
				<use xlink:href="#icon-arrow_pagination"></use>
			</svg>
		</a>
		@endif
		<ul class="df-pagination__pages">
		@for($i = 0, $k = floor($limit / 2) * (-1); $i < $limit; $i++, $k++)
			<?php
			$num = $paginator->currentPage() + $k;
			?>
			@if($num > 0 && $num <= $paginator->lastPage())
			<li class="df-pagination__page">
				<a href="{{ $paginator->url($num) }}" class="df-pagination__link {{ $paginator->currentPage() == $num ? 'active' : '' }}">{{ $num }}</a>
			</li>
			@endif
		@endfor
		</ul>
		@if($paginator->currentPage() != $paginator->lastPage())
		<a href="{{ $paginator->nextPageUrl() }}" class="df-pagination__next">
			<svg aria-hidden="true">
				<use xlink:href="#icon-arrow_pagination"></use>
			</svg>
		</a>
		<a href="{{ $paginator->url($paginator->lastPage()) }}" class="df-pagination__last">
			<svg aria-hidden="true">
				<use xlink:href="#icon-arrow_pagination"></use>
			</svg>
			<svg aria-hidden="true">
				<use xlink:href="#icon-arrow_pagination"></use>
			</svg>
		</a>
		@endif
	</div>
@endif
