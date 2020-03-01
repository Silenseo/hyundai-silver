<aside class="sidebar">
	<ul class="sidebar__list">
		@u_userpermission('users_admin_main')
		<li class="sidebar__item">
			<a href="{{ route('admin.users.index') }}" class="sidebar__link">
				<div class="sidebar__icon">
					<svg width="29" height="32" viewBox="0 0 29 32" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M19.6829 8.58537C19.6829 12.9868 17.1854 15.7805 14.0488 15.7805C10.9122 15.7805 8.41463 12.9868 8.41463 8.58537C8.41463 6.32931 8.8823 4.4092 9.7984 3.08293C10.6793 1.80766 12.0259 1 14.0488 1C16.0717 1 17.4183 1.80766 18.2992 3.08293C19.2153 4.4092 19.6829 6.32931 19.6829 8.58537Z"
						 stroke="#666666" stroke-width="2" />
						<path d="M9.7561 17.1707C7.80488 19.4412 1.56097 18.6844 1.56097 23.6038V25.8744C1.82114 27.1357 5.30732 29.6585 14.0488 29.6585"
						 stroke="#666666" stroke-width="2" />
						<path d="M18.3415 17.1707C20.2927 19.4412 26.5366 18.6844 26.5366 23.6038V25.8744C26.2764 27.1357 22.7902 29.6585 14.0488 29.6585"
						 stroke="#666666" stroke-width="2" />
					</svg>
				</div>
				<span>Пользователи</span>
			</a>
		</li>
		@endu_userpermission
		@u_userpermission('user_roles_admin_main')
		<li class="sidebar__item">
			<a href="{{ route('admin.user_roles.index') }}" class="sidebar__link">
				<div class="sidebar__icon">
					<svg width="29" height="32" viewBox="0 0 29 32" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M19.6829 8.58537C19.6829 12.9868 17.1854 15.7805 14.0488 15.7805C10.9122 15.7805 8.41463 12.9868 8.41463 8.58537C8.41463 6.32931 8.8823 4.4092 9.7984 3.08293C10.6793 1.80766 12.0259 1 14.0488 1C16.0717 1 17.4183 1.80766 18.2992 3.08293C19.2153 4.4092 19.6829 6.32931 19.6829 8.58537Z"
						 stroke="#666666" stroke-width="2" />
						<path d="M9.7561 17.1707C7.80488 19.4412 1.56097 18.6844 1.56097 23.6038V25.8744C1.82114 27.1357 5.30732 29.6585 14.0488 29.6585"
						 stroke="#666666" stroke-width="2" />
						<path d="M18.3415 17.1707C20.2927 19.4412 26.5366 18.6844 26.5366 23.6038V25.8744C26.2764 27.1357 22.7902 29.6585 14.0488 29.6585"
						 stroke="#666666" stroke-width="2" />
					</svg>
				</div>
				<span>Группы пользователей</span>
			</a>
		</li>
		@endu_userpermission
		@u_userpermission('jobseekers_admin_main')
		<li class="sidebar__item">
			<a href="{{ route('admin.jobseekers.index') }}" class="sidebar__link">
				<div class="sidebar__icon">
					<svg width="29" height="32" viewBox="0 0 29 32" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M19.6829 8.58537C19.6829 12.9868 17.1854 15.7805 14.0488 15.7805C10.9122 15.7805 8.41463 12.9868 8.41463 8.58537C8.41463 6.32931 8.8823 4.4092 9.7984 3.08293C10.6793 1.80766 12.0259 1 14.0488 1C16.0717 1 17.4183 1.80766 18.2992 3.08293C19.2153 4.4092 19.6829 6.32931 19.6829 8.58537Z"
						 stroke="#666666" stroke-width="2" />
						<path d="M9.7561 17.1707C7.80488 19.4412 1.56097 18.6844 1.56097 23.6038V25.8744C1.82114 27.1357 5.30732 29.6585 14.0488 29.6585"
						 stroke="#666666" stroke-width="2" />
						<path d="M18.3415 17.1707C20.2927 19.4412 26.5366 18.6844 26.5366 23.6038V25.8744C26.2764 27.1357 22.7902 29.6585 14.0488 29.6585"
						 stroke="#666666" stroke-width="2" />
					</svg>
				</div>
				<span>Соискатели</span>
			</a>
		</li>
		@endu_userpermission
		@u_userpermission('seo_admin_main')
		<li class="sidebar__item">
			<a href="{{ route('admin.seo.index') }}" class="sidebar__link">
				<div class="sidebar__icon">
					<svg width="32" height="31" viewBox="0 0 32 31" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0 19C14.4 19 5.5 1 15.5 1C21.9 1 18.4 11 25.2 11H30" stroke="#666666" stroke-width="2" />
						<path d="M27.1486 6.59998L29.5555 10.4292C29.7728 10.7748 29.7728 11.2251 29.5555 11.5707L27.1486 15.4" stroke="#666666"
						 stroke-width="2" />
						<rect y="25" width="2" height="6" fill="#666666" />
						<rect x="7" y="22" width="2" height="9" fill="#666666" />
						<rect x="14" y="9" width="2" height="22" fill="#666666" />
						<rect x="21" y="16" width="2" height="15" fill="#666666" />
						<rect x="28" y="19" width="2" height="12" fill="#666666" />
					</svg>
				</div>
				<span>SEO-данные</span>
			</a>
		</li>
		@endu_userpermission
		@u_userpermission('news_admin_main')
		<li class="sidebar__item">
			<a href="{{ route('admin.news.index' )}}" class="sidebar__link">
				<div class="sidebar__icon">
					<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M5 1H20.4056L27 7.42199V31H5V1Z" stroke="#666666" stroke-width="2" />
						<path d="M8 8H16" stroke="#666666" stroke-width="2" />
						<path d="M8 13H24" stroke="#666666" stroke-width="2" />
						<path d="M8 18H24" stroke="#666666" stroke-width="2" />
						<path d="M8 23H19" stroke="#666666" stroke-width="2" />
					</svg>
				</div>
				<span>Новости</span>
			</a>
		</li>
		@endu_userpermission
		@u_userpermission('banners_admin_main')
		<li class="sidebar__item">
			<a href="{{ route('admin.banners.index') }}" class="sidebar__link">
				<div class="sidebar__icon">
					<svg width="32" height="24" viewBox="0 0 32 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<rect x="1" y="1" width="30" height="17" stroke="#666666" stroke-width="2" />
						<rect x="5" y="5" width="22" height="2" fill="#666666" />
						<rect x="5" y="22" width="22" height="2" fill="#666666" />
						<rect x="5" y="10" width="13" height="2" fill="#666666" />
					</svg>
				</div>
				<span>Баннеры</span>
			</a>
		</li>
		@endu_userpermission
		@u_userpermission('cars_admin_main')
		<li class="sidebar__item">
			<a href="{{ route('admin.cars.index') }}" class="sidebar__link">
				<div class="sidebar__icon">
					<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
						<circle cx="16" cy="16" r="15" stroke="#666666" stroke-width="2" />
						<circle r="4.6" transform="matrix(1 0 0 -1 16 16)" stroke="#666666" stroke-width="2" />
						<circle r="10.2" transform="matrix(1 0 0 -1 16 16)" stroke="#666666" stroke-width="2" />
						<path d="M16 5.59998V11.5" stroke="#666666" stroke-width="2" />
						<path d="M16 20V26.4" stroke="#666666" stroke-width="2" />
						<path d="M26.4 16H20" stroke="#666666" stroke-width="2" />
						<path d="M12 16L6 16" stroke="#666666" stroke-width="2" />
						<path d="M23.3539 8.64606L19 13" stroke="#666666" stroke-width="2" />
						<path d="M13 19L8.64594 23.3539" stroke="#666666" stroke-width="2" />
						<path d="M23.3539 23.3539L19 19" stroke="#666666" stroke-width="2" />
						<path d="M13 13L8.64594 8.64607" stroke="#666666" stroke-width="2" />
					</svg>
				</div>
				<span>Автомобили</span>
			</a>
		</li>
		@endu_userpermission
		@u_userpermission('special_offers_admin_main')
		<li class="sidebar__item">
			<a href="{{ route('admin.special_offer_labels.index') }}" class="sidebar__link">
				<div class="sidebar__icon">
					<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
						<circle cx="11.2" cy="11.2" r="3" stroke="#666666" stroke-width="2" />
						<circle cx="20.8" cy="20.8" r="3" stroke="#666666" stroke-width="2" />
						<path d="M23.2 8.79999L8.8 23.2" stroke="#666666" stroke-width="2" />
						<circle cx="16" cy="16" r="15" stroke="#666666" stroke-width="2" />
					</svg>
				</div>
				<span>Спецпредложения: лейблы</span>
			</a>
		</li>
		@endu_userpermission
		@u_userpermission('special_offers_admin_main')
		<li class="sidebar__item">
			<a href="{{ route('admin.special_offers.index') }}" class="sidebar__link">
				<div class="sidebar__icon">
					<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
						<circle cx="11.2" cy="11.2" r="3" stroke="#666666" stroke-width="2" />
						<circle cx="20.8" cy="20.8" r="3" stroke="#666666" stroke-width="2" />
						<path d="M23.2 8.79999L8.8 23.2" stroke="#666666" stroke-width="2" />
						<circle cx="16" cy="16" r="15" stroke="#666666" stroke-width="2" />
					</svg>
				</div>
				<span>Спецпредложения</span>
			</a>
		</li>
		@endu_userpermission
		@u_userpermission('placeholders_admin_main')
		<li class="sidebar__item">
			<a href="{{ route('admin.placeholders.index') }}" class="sidebar__link">
				<div class="sidebar__icon">
					<svg width="32" height="31" viewBox="0 0 32 31" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0 19C14.4 19 5.5 1 15.5 1C21.9 1 18.4 11 25.2 11H30" stroke="#666666" stroke-width="2" />
						<path d="M27.1486 6.59998L29.5555 10.4292C29.7728 10.7748 29.7728 11.2251 29.5555 11.5707L27.1486 15.4" stroke="#666666"
						 stroke-width="2" />
						<rect y="25" width="2" height="6" fill="#666666" />
						<rect x="7" y="22" width="2" height="9" fill="#666666" />
						<rect x="14" y="9" width="2" height="22" fill="#666666" />
						<rect x="21" y="16" width="2" height="15" fill="#666666" />
						<rect x="28" y="19" width="2" height="12" fill="#666666" />
					</svg>
				</div>
				<span>Плейсхолдеры</span>
			</a>
		</li>
		@endu_userpermission
		<li class="sidebar__item">
			<a href="{{ route('admin.warranty_cars.index') }}" class="sidebar__link">
				<div class="sidebar__icon">
					<svg width="32" height="31" viewBox="0 0 32 31" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0 19C14.4 19 5.5 1 15.5 1C21.9 1 18.4 11 25.2 11H30" stroke="#666666" stroke-width="2" />
						<path d="M27.1486 6.59998L29.5555 10.4292C29.7728 10.7748 29.7728 11.2251 29.5555 11.5707L27.1486 15.4" stroke="#666666"
						 stroke-width="2" />
						<rect y="25" width="2" height="6" fill="#666666" />
						<rect x="7" y="22" width="2" height="9" fill="#666666" />
						<rect x="14" y="9" width="2" height="22" fill="#666666" />
						<rect x="21" y="16" width="2" height="15" fill="#666666" />
						<rect x="28" y="19" width="2" height="12" fill="#666666" />
					</svg>
				</div>
				<span>Гарантии на автомобили</span>
			</a>
		</li>
		@u_userpermission('manuals_admin_main')
		<li class="sidebar__item">
			<a href="{{ route('admin.manuals.index') }}" class="sidebar__link">
				<div class="sidebar__icon">
					<svg width="32" height="31" viewBox="0 0 32 31" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0 19C14.4 19 5.5 1 15.5 1C21.9 1 18.4 11 25.2 11H30" stroke="#666666" stroke-width="2" />
						<path d="M27.1486 6.59998L29.5555 10.4292C29.7728 10.7748 29.7728 11.2251 29.5555 11.5707L27.1486 15.4" stroke="#666666"
						 stroke-width="2" />
						<rect y="25" width="2" height="6" fill="#666666" />
						<rect x="7" y="22" width="2" height="9" fill="#666666" />
						<rect x="14" y="9" width="2" height="22" fill="#666666" />
						<rect x="21" y="16" width="2" height="15" fill="#666666" />
						<rect x="28" y="19" width="2" height="12" fill="#666666" />
					</svg>
				</div>
				<span>Руководства и каталоги</span>
			</a>
		</li>
		@endu_userpermission
		@u_userpermission('storage_photos_admin_main')
		<li class="sidebar__item">
			<a href="{{ route('admin.storage_photos.index') }}" class="sidebar__link">
				<div class="sidebar__icon">
					<svg width="32" height="31" viewBox="0 0 32 31" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0 19C14.4 19 5.5 1 15.5 1C21.9 1 18.4 11 25.2 11H30" stroke="#666666" stroke-width="2" />
						<path d="M27.1486 6.59998L29.5555 10.4292C29.7728 10.7748 29.7728 11.2251 29.5555 11.5707L27.1486 15.4" stroke="#666666"
						 stroke-width="2" />
						<rect y="25" width="2" height="6" fill="#666666" />
						<rect x="7" y="22" width="2" height="9" fill="#666666" />
						<rect x="14" y="9" width="2" height="22" fill="#666666" />
						<rect x="21" y="16" width="2" height="15" fill="#666666" />
						<rect x="28" y="19" width="2" height="12" fill="#666666" />
					</svg>
				</div>
				<span>Фотохранилище</span>
			</a>
		</li>
		@endu_userpermission
		@u_userpermission('dealer_menu_admin_main')
		<li class="sidebar__item">
			<a href="{{ route('admin.dealer_menu_categories.index') }}" class="sidebar__link">
				<div class="sidebar__icon">
					<svg width="32" height="31" viewBox="0 0 32 31" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0 19C14.4 19 5.5 1 15.5 1C21.9 1 18.4 11 25.2 11H30" stroke="#666666" stroke-width="2" />
						<path d="M27.1486 6.59998L29.5555 10.4292C29.7728 10.7748 29.7728 11.2251 29.5555 11.5707L27.1486 15.4" stroke="#666666"
						 stroke-width="2" />
						<rect y="25" width="2" height="6" fill="#666666" />
						<rect x="7" y="22" width="2" height="9" fill="#666666" />
						<rect x="14" y="9" width="2" height="22" fill="#666666" />
						<rect x="21" y="16" width="2" height="15" fill="#666666" />
						<rect x="28" y="19" width="2" height="12" fill="#666666" />
					</svg>
				</div>
				<span>Дилерское меню - категории</span>
			</a>
		</li>
		<li class="sidebar__item">
			<a href="{{ route('admin.dealer_menu_pages.index') }}" class="sidebar__link">
				<div class="sidebar__icon">
					<svg width="32" height="31" viewBox="0 0 32 31" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0 19C14.4 19 5.5 1 15.5 1C21.9 1 18.4 11 25.2 11H30" stroke="#666666" stroke-width="2" />
						<path d="M27.1486 6.59998L29.5555 10.4292C29.7728 10.7748 29.7728 11.2251 29.5555 11.5707L27.1486 15.4" stroke="#666666"
						 stroke-width="2" />
						<rect y="25" width="2" height="6" fill="#666666" />
						<rect x="7" y="22" width="2" height="9" fill="#666666" />
						<rect x="14" y="9" width="2" height="22" fill="#666666" />
						<rect x="21" y="16" width="2" height="15" fill="#666666" />
						<rect x="28" y="19" width="2" height="12" fill="#666666" />
					</svg>
				</div>
				<span>Дилерское меню - страницы</span>
			</a>
		</li>
		@endu_userpermission
	</ul>
</aside>
