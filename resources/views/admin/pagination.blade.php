<?php
$limit = 7;
?>

@if($paginator->lastPage() > 1)
<div class="content__line content__line--center">
	<div class="pagination">
		@if($paginator->currentPage() != 1)
		<a href="{{ $paginator->url(1) }}" class="pagination__first">
			<svg width="14" height="12" viewBox="0 0 14 12" fill="none" xmlns="http://www.w3.org/2000/svg">
				<g clip-path="url(#clip0)">
					<path d="M13 11L9.10207 6.66896C8.75979 6.28866 8.75979 5.71134 9.10207 5.33103L13 1" stroke="#B7B7B7" stroke-width="2" />
				</g>
				<g clip-path="url(#clip1)">
					<path d="M6 11L2.10207 6.66896C1.75979 6.28866 1.75979 5.71134 2.10207 5.33103L6 1" stroke="#B7B7B7" stroke-width="2" />
				</g>
				<defs>
					<clipPath id="clip0">
						<rect width="7" height="12" fill="white" transform="translate(14 12) rotate(-180)" />
					</clipPath>
					<clipPath id="clip1">
						<rect width="7" height="12" fill="white" transform="translate(7 12) rotate(-180)" />
					</clipPath>
				</defs>
			</svg>
		</a>
		<a href="{{ $paginator->previousPageUrl() }}" class="pagination__prev">
			<svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M6 11L2.10207 6.66896C1.75979 6.28866 1.75979 5.71134 2.10207 5.33103L6 1" stroke="#B7B7B7" stroke-width="2" />
			</svg>
		</a>
		@endif
		<ul class="pagination__pages">
		@for($i = 0, $k = floor($limit / 2) * (-1); $i < $limit; $i++, $k++)
			<?php
			$num = $paginator->currentPage() + $k;
			?>
			@if($num > 0 && $num <= $paginator->lastPage())
			<li class="pagination__page">
				<a href="{{ $paginator->url($num) }}" class="pagination__link {{ $paginator->currentPage() == $num ? 'active' : '' }}">{{ $num }}</a>
			</li>
			@endif
		@endfor
		</ul>
		@if($paginator->currentPage() != $paginator->lastPage())
		<a href="{{ $paginator->nextPageUrl() }}" class="pagination__prev">
			<svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M1 1L4.89793 5.33104C5.24021 5.71134 5.24021 6.28866 4.89793 6.66897L0.999998 11" stroke="#B7B7B7"
				 stroke-width="2" />
			</svg>
		</a>
		<a href="{{ $paginator->url($paginator->lastPage()) }}" class="pagination__last">
			<svg width="14" height="12" viewBox="0 0 14 12" fill="none" xmlns="http://www.w3.org/2000/svg">
				<g clip-path="url(#clip2)">
					<path d="M1 1L4.89793 5.33104C5.24021 5.71134 5.24021 6.28866 4.89793 6.66897L0.999998 11" stroke="#B7B7B7"
					 stroke-width="2" />
				</g>
				<g clip-path="url(#clip3)">
					<path d="M8 1L11.8979 5.33104C12.2402 5.71134 12.2402 6.28866 11.8979 6.66897L8 11" stroke="#B7B7B7" stroke-width="2" />
				</g>
				<defs>
					<clipPath id="clip2">
						<rect width="7" height="12" fill="white" />
					</clipPath>
					<clipPath id="clip3">
						<rect width="7" height="12" fill="white" transform="translate(7)" />
					</clipPath>
				</defs>
			</svg>
		</a>
		@endif
	</div>
</div>
@endif
