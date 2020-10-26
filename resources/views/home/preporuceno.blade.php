<div id="homeBlockSlider" class="preporucenoBlock mt-4">

  <h2>{{ $specialOptionBlockTitle_Preporuceno }}</h2>

<div id="preporucenoSlider" class="pt-3 pb-3">

    @foreach($productFor_Preporuceno as $tab1Spec)
        <div class="prodOne white pl-0 pr-0 ml-3 mr-3 wow animated fadeIn shadow-sm">

          <div class="imgWrap">
            <div class="row pr-3 pl-3">
              <div class="col">
                  <div id="addTo_FAV" class="prod_{{ $tab1Spec->p_id }}" onclick="FavEvent({{ $tab1Spec->p_id }})">
                      <i class="far fa-heart fa-2x text-primary {{ (in_array($tab1Spec->p_id,$favLIST))? 'd-none':'d-block' }}"></i>
                      <i class="fas fa-heart fa-2x text-primary {{ (in_array($tab1Spec->p_id,$favLIST))? 'd-block':'d-none' }}"></i>
                  </div>
                </div>
                <div class="col">
                  @if ($tab1Spec->so_title != '')
                    <div class="akcijaNOTE" style="background-color: {{ ($tab1Spec->cat_color != null)? $tab1Spec->cat_color:'' }};">Akcija</div>
                  @endif
                  
                  @if ($tab1Spec->b_title != '')
                    <div class="bedz" style="background-color: {{ ($tab1Spec->cat_color != null)? $tab1Spec->cat_color:'' }};">
                      {{ $tab1Spec->b_title }} 
                      <div class="text-center" style="font-size:12px;font-weight:normal;margin-top:-10px;">poena</div>
                    </div>
                  @endif
                </div>
            </div>
                  
                  <a href="{{ ($tab1Spec->pcat_id != 3)? trans('shop.slug_url_products'):'' }}/{{ $tab1Spec->pcat_slug }}/{{ $tab1Spec->cat_slug }}/{{ $tab1Spec->p_slug }}"><img src="/storage/products/{{ ($tab1Spec->p_image != null)? $tab1Spec->p_image:'no_image.jpg' }}" alt="{{ $tab1Spec->p_title }}" class="img100"></a>
            </div>

            <h3><a href="{{ ($tab1Spec->pcat_id != 3)? trans('shop.slug_url_products'):'' }}/{{ $tab1Spec->pcat_slug }}/{{ $tab1Spec->cat_slug }}/{{ $tab1Spec->p_slug }}">{{ $tab1Spec->p_title }}</a></h3>


            <div class="container productCardBottom">
              <div class="row justify-content-center">
                <div class="priceWrap" style="color: {{ ($tab1Spec->cat_color != null)? $tab1Spec->cat_color:'' }};">
                  @if ($tab1Spec->p_product_price_with_discount != null)
                  <div class="row justify-content-center">
                    <div class="col-6 small text-right text-secondary pr-1">Cena:</div>
                    <span class="fullPrice font-weight-bold text-lowercase small col-6 text-left pl-0">{{ number_format($tab1Spec->p_product_price,0,"",".") }} {{ setting('site.valuta') }}</span>
                    <span class="discountPrice font-weight-bold text-lowercase col-12 text-center" style="color: {{ ($tab1Spec->cat_color != null)? $tab1Spec->cat_color:'' }};">{{ number_format($tab1Spec->p_product_price_with_discount,0,"",".") }} {{ setting('site.valuta') }}</span>
                  </div>
                    @else
                    <div class="row justify-content-center">
                      <div class="col-12 small text-center text-secondary">Cena:</div>
                      <span class="singlePrice m-0 font-weight-bold text-lowercase " style="color: {{ ($tab1Spec->cat_color != null)? $tab1Spec->cat_color:'' }};">{{ number_format($tab1Spec->p_product_price,0,"",".") }} {{ setting('site.valuta') }}</span>
                    </div>
                    @endif
                </div>
              </div>
                <div class="row justify-content-center mt-3">
                  <button id="addTo_CART" class="btn btn-rounded btnBuy {{ ($tab1Spec->cat_color == null)? 'primary-color':'' }} text-white  pl-3 pr-3 pt-1 pb-1" style="background-color: {{ ($tab1Spec->cat_color != null)? $tab1Spec->cat_color:'' }};"  onclick="CartEvent({{ $tab1Spec->p_id }},0)">
                     @lang('shop.btn_buy')
                  </button>
                </div>
                <div class="row justify-content-center mt-3 ">
                  <span class="border {{ ($tab1Spec->cat_color == null)? 'primary-color':'' }}  col-12 border-5" style="background-color: {{ ($tab1Spec->cat_color != null)? $tab1Spec->cat_color:'' }};"></span>
                </div>
            </div>

          </div>
    @endforeach

</div>

@php
// echo '<pre>';
// print_r($productFor_Novo);
// echo '</pre>';
@endphp



<script type="text/javascript">
$(document).ready(function(){

  $('#preporucenoSlider').slick({
    arrows: false,
    dots: true,
    draggable: true,
    infinite: false,
    autoplay: true,
    autoplaySpeed: 4000,
    slidesToShow: 6,
    slidesToScroll: 6,
    row: 0,
    responsive: [
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 4,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3
        }
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 576,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  }).on('setPosition', function (event, slick) {
      slick.$slides.css('height', slick.$slideTrack.height() + 'px');
  });

});
</script>

</div>