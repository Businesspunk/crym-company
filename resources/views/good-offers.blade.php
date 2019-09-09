@extends('components/layout')

@section('content')
<main>
	@include('components/sub-menu', ['title' => 'Недвижимость на особых условиях'])
	<section class="goodOffers">
		<div class="container">
		<div class="desc">
			<p>Мы предоставляем своим клиентам помощь по всем вопросам в отношении недвижимости. Есть возможность комплексного подхода
				"Передача недвижимости её новому хозяину под ключ " в которую входит :
			</p>
			<ol>
				<li>Поиск лучшего объекта недвижимости по запросу (для покупателя)</li>
				<li>Поиск достойного покупателя на объект недвижимости (для продавца) </li>
				<li>Проведение оценки объекта недвижимости (в случае необходимости)</li>
				<li>Обеспечение открытости, законности и чистоты при продаже-покупке объекта недвижимости.</li>
			</ol>
			<p>Также есть возможность оказания помощи клиенту в отдельной из частей указанных выше. </p>
			<p>Для улучшения условий на стадии предварительного осмотра покупателем объекта недвижимости в Крыму, по желанию клиента, осуществляется помощь в организации расселения в лучших гостиницах, отелях и домах отдыха. А также организация досуга, развлечений, экскурсий и всего остального, что позволит нашему клиенту запомнить поездку в Крым на всю свою жизнь.</p>
			<p>После приобретения клиентом своего объекта недвижимости также предоставляем услуги по организации строительства и решению сопутствующих вопросов. </p>
			<p>Специалисты по интерьеру и экстерьеру помогут воплотить все Ваши фантазии и сказочные представления в жизнь и сделать из Вашего приобретенного объекта недвижимости действительно "Райский уголок в живописном Крыму".</p>
		</div>

			@forelse( $categories as $category )
				<div class="block">
					<div class="h4">{{ $category->name }}</div>
					@include('components/posts', [	
						'posts' => $category->getVip()->paginate($postsPerPage),
						'type' => $category->slug
					])
				</div>
			@empty
				Объявлений пока нет
			@endforelse
			
		</div>
	</section>
</main>
@endsection