<div class="specTABs">
{{-- nav nav-tabs md-tabs --}}
  <ul class=" nav nav-justified  ml-0 mr-0 p-0 rounded-0 z-depth-0 " id="tabsSpecial" role="tablist">
    @foreach ($specialOptions_tabs as $key => $tab)
    <li class="nav-item">
        {{-- {{ ($tab->id == 1)? 'active':'' }} --}}
      <a class="nav-link active rounded-0" orderVAL="{{ $tab->id }}" id="spec_{{ $tab->id }}-tab-just" data-toggle="tab" href="#spec_{{ $tab->id }}-just" role="tab" aria-controls="spec_{{ $tab->id }}-just" aria-selected="true">
      	{{ $tab->title }}
      </a>
    </li>
    @endforeach
  </ul>

  <div class="tab-content card p-0 pt-3 rounded-0 z-depth-0" id="SpecTabsContent">
  @foreach ($specialOptions_tabs as $key => $tab)
    <div class="tab-pane fade show active " id="spec_{{ $tab->id }}-just" role="tabpanel" aria-labelledby="spec_{{ $tab->id }}-tab-just">
{{-- {{ ($tab->id == 1)? 'show active':'' }} --}}
      <div id="specOPT{{ $tab->id }}_slider" class="pt-3 pb-3">

        @if (array_key_exists($tab->id,$productWithSelectedOptions_groupped))

        @foreach($productWithSelectedOptions_groupped[$tab->id] as $tab1 => $tab1Spec)
          <div class="prodOne white pl-0 pr-0 ml-3 mr-3">

            <div class="imgWrap">
                  <div class="row pr-3 pl-3">
                    <div class="col">
                        <div id="addTo_FAV" class="prod_{{ $tab1Spec->p_id }}" onclick="FavEvent({{ $tab1Spec->p_id }})">
                            <i class="far fa-heart fa-2x text-primary {{ (in_array($tab1Spec->p_id,$favLIST))? 'd-none':'d-block' }}"></i>
                            <i class="fas fa-heart fa-2x text-primary {{ (in_array($tab1Spec->p_id,$favLIST))? 'd-block':'d-none' }}"></i>
                        </div>
                      </div>
                  </div>
                  
                  <a href="{{ ($tab1Spec->pcat_id != 3)? trans('shop.slug_url_products'):'' }}/{{ $tab1Spec->pcat_slug }}/{{ $tab1Spec->cat_slug }}/{{ $tab1Spec->p_slug }}"><img src="/storage/products/{{ ($tab1Spec->p_image != null)? $tab1Spec->p_image:'no_image.jpg' }}" alt="{{ $tab1Spec->p_title }}" class="img100"></a>
            </div>

            <h3><a href="{{ ($tab1Spec->pcat_id != 3)? trans('shop.slug_url_products'):'' }}/{{ $tab1Spec->pcat_slug }}/{{ $tab1Spec->cat_slug }}/{{ $tab1Spec->p_slug }}">{{ $tab1Spec->p_title }}</a></h3>

                  <div class="container productCardBottom">
                      <div class="row justify-content-center">
                        <div class="priceWrap" >
                          @if ($tab1Spec->p_product_price_with_discount != null)
                          <div class="row justify-content-center text-secondary">
                            Cena:<span class="fullPrice ">{{ number_format($tab1Spec->p_product_price,0,"",".") }} {{ setting('site.valuta') }}</span>
                          </div>
                          <div class="row justify-content-center ">
                            <span class="discountPrice {{ ($tab1Spec->cat_color == null)? 'primary-color':'' }} " style="color: {{ ($tab1Spec->cat_color != null)? $tab1Spec->cat_color:'' }};">{{ number_format($tab1Spec->p_product_price_with_discount,0,"",".") }} {{ setting('site.valuta') }}</span>
                          </div>
                            @else
                      <label class="text-secondary m-0" style="display: block;" align="middle">Cena:</label><span class="singlePrice m-0 " style="color: {{ ($tab1Spec->cat_color != null)? $tab1Spec->cat_color:'' }};">{{ number_format($tab1Spec->p_product_price,0,"",".") }} {{ setting('site.valuta') }}</span>
                            @endif
                        </div>
                      </div>
                        <div class="row justify-content-center mt-3">
                          <div id=""  class="rounded-pill buyButton {{ ($tab1Spec->cat_color == null)? 'primary-color':'' }} text-white  pl-3 pr-3 pt-1 pb-1" style="background-color: {{ ($tab1Spec->cat_color != null)? $tab1Spec->cat_color:'' }};"  onclick="CartEvent({{ $tab1Spec->p_id }})">
                             @lang('shop.btn_buy')
                          </div>
                        </div>
                <div class="row justify-content-center mt-3 ">
                  <span class="border {{ ($tab1Spec->cat_color == null)? 'primary-color':'' }}  col-12 border-5" style="background-color: {{ ($tab1Spec->cat_color != null)? $tab1Spec->cat_color:'' }};"></span>
                </div>
                        
                  </div>

          </div>
        @endforeach

        @endif

      </div>
      
        <script type="text/javascript">
        $(document).ready(function(){

          $('#specOPT{{ $tab->id }}_slider').slick({
            arrows: true,
            dots: false,
            draggable: true,
            infinite: false,
            autoplay: true,
            autoplaySpeed: 4000,
            slidesToShow: 6,
            slidesToScroll: 4,
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
  @endforeach

</div>

</div>

@php
// echo '<pre style="color: white;">';
// print_r($favLIST);
// echo '</pre>';
@endphp