  <!-- Left side column. contains the logo and sidebar -->
  <aside id="mainSidebar" class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          @if(auth()->user()->image != '' && file_exists(public_path().'/images/user/'.auth()->user()->image))
            
            <img src="{{url('images/user/'.auth()->user()->image)}}" class="img-rounded img-responsive" alt="User Image">
           
          @else
            
            <img class="img-responsive" title="{{ Auth::user()->name }}" src="{{ Avatar::create(Auth::user()->name)->toBase64() }}"/>

          @endif
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
        </div>
      </div>

      <ul class="sidebar-menu" data-widget="tree">

        <li id="dashboard" class="{{ Nav::isRoute('admin.main') }}">
          <a class="treeview" href="{{ route('admin.main') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>

          </a>
        </li>



        @canany(['users.view','roles.view'])
        <li class="treeview {{ Nav::isResource('roles') }} {{ Nav::isResource('users') }}">
              <a href="#">
                <i class="fa fa-users" aria-hidden="true"></i> <span>Users</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
    
              <ul class="treeview-menu">
                
              @can('users.view')
              <li class="{{ Nav::isResource('users') }}"><a href="{{ route('users.index') }} "><i
                  class="fa fa-circle-o"></i>All users </a></li>
              @endcan

              @can('roles.view')

                <li class="{{ Nav::isResource('roles') }}"><a href="{{ route('roles.index') }}"><i
                      class="fa fa-circle-o"></i>Roles and Permissions</a></li>
              @endcan
                
              </ul>
        </li>
        @endcan

        @can('menu.view')
        <li id="menum" class="{{ Nav::isResource('admin/menu') }}">
          <a class="treeview" href="{{ route('menu.index') }}">
            <i class="fa fa-window-restore" aria-hidden="true"></i> <span>Menu Management</span>

          </a>
        </li>
        @endcan

       @if(isset($vendor_system) && $vendor_system == 1)
       @canany(['stores.accept.request','stores.view'])
        <li class="treeview {{ Nav::isRoute('get.store.request') }} {{ Nav::isResource('stores') }}">
          <a href="#">
            <i class="fa fa-cart-plus" aria-hidden="true"></i> <span>Stores</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <ul class="treeview-menu">
            @can('stores.view')
            <li class="{{ Nav::isResource('stores') }}"><a href="{{url('admin/stores')}} "><i
                  class="fa fa-circle-o"></i>Stores </a></li>
            @endcan
            
            @if($vendor_system==1)
              @can('stores.accept.request')
                <li class="{{ Nav::isRoute('get.store.request') }}"><a href="{{route('get.store.request')}} ">
                  <i class="fa fa-circle-o"></i>Stores Request</a>
                </li>
              @endcan
            @endif
          </ul>
        </li>
        @endcan
        @endif

        @canany(['review.view','brand.view','category.view','subcategory.view','childcategory.view','products.view','products.import','attributes.view','coupans.view','returnpolicy.view','units.view','specialoffer.view'])
        <li id="prom" class="treeview {{ Nav::isResource('admin/commission_setting') }} {{ Nav::isResource('admin/commission') }} {{ Nav::isRoute('review.index') }} {{ Nav::isRoute('r.ap') }} {{ Nav::isResource('admin/return-policy') }} {{ Nav::isResource('brand') }} {{ Nav::isResource('coupan') }} {{ Nav::isResource('category') }} {{ Nav::isResource('subcategory') }} {{ Nav::isResource('grandcategory') }} {{ Nav::isResource('products') }} {{ Nav::isResource('unit') }} {{ Nav::isResource('special') }} {{ Nav::isRoute('attr.index') }} {{ Nav::isRoute('attr.add') }} {{ Nav::isRoute('opt.edit') }} {{ Nav::isRoute('pro.val') }} {{ Nav::isRoute('add.var') }} {{ Nav::isRoute('manage.stock') }} {{ Nav::isRoute('edit.var') }} {{ Nav::isRoute('pro.vars.all') }} {{ Nav::isRoute('import.page') }} {{ Nav::isRoute('requestedbrands.admin') }}">
          <a href="#">
            <i class="fa fa-shopping-basket" aria-hidden="true"></i> <span>Products Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            @can('brand.view')
            <li class="{{ Nav::isResource('brand') }}"><a href="{{url('admin/brand')}} "><i
                  class="fa fa-circle-o"></i>Brands</a></li>
            @if($genrals_settings->vendor_enable == 1)
            <li class="{{ Nav::isRoute('requestedbrands.admin') }}"><a href="{{route('requestedbrands.admin')}} "><i
                  class="fa fa-circle-o"></i>Requested Brands

                @php
                $brands = App\Brand::where('is_requested','=','1')->where('status','0')->orderBy('id','DESC')->count();
                @endphp

                @if($brands !=0)
                <span class="pull-right-container">
                  <small class="label pull-right bg-red">{{ $brands }}</small>
                </span>
                @endif

              </a></li>
            @endif
            @endcan
            <li
              class="treeview {{ Nav::isResource('category') }} {{ Nav::isResource('subcategory') }} {{ Nav::isResource('grandcategory') }}">
              <a href="#"><i class="fa fa-circle-o"></i>Categories
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                @can('category.view')
                <li
                  class="{{ Nav::isRoute('category.index') }} {{ Nav::isRoute('category.create') }} {{ Nav::isRoute('category.edit') }}">
                  <a href="{{url('admin/category')}}"><i class="fa fa-circle-o"></i>Categories</a></li>
                @endcan
                @can('subcategory.view')
                <li class="{{ Nav::isResource('subcategory') }}"><a href="{{url('admin/subcategory')}}"><i
                      class="fa fa-circle-o"></i>Subcategories</a></li>
                @endcan
                @can('childcategory.view')
                <li class="{{ Nav::isResource('grandcategory') }}"><a href="{{url('admin/grandcategory')}}"><i
                      class="fa fa-circle-o"></i>Childcategories</a></li>
                @endcan
              </ul>
            </li>
            @can('products.view')
            <li
              class="{{ Nav::isRoute('pro.vars.all') }} {{ Nav::isResource('products') }} {{ Nav::isRoute('add.var') }} {{ Nav::isRoute('manage.stock') }} {{ Nav::isRoute('edit.var') }}">
              <a href="{{url('admin/products')}} "> <i class="fa fa-circle-o"></i>Variant Products </a></li>
            @endcan
            @can('digital-products.view')
            <li class="{{ Nav::isResource('simple-products') }}">
              <a href="{{ route('simple-products.index') }} "> <i class="fa fa-circle-o"></i>{{__("Simple Products")}}</a></li>
            @endcan
            @can('products.import')
            <li class="{{ Nav::isRoute('import.page') }}"><a href="{{ route('import.page') }}"><i
                  class="fa fa-circle-o"></i>Import Products</a></li>
            @endcan

            @can('attributes.view')
            <li
              class="{{ Nav::isRoute('pro.val') }} {{ Nav::isRoute('opt.edit') }} {{ Nav::isRoute('attr.add') }}{{ Nav::isRoute('attr.index') }}">
              <a href="{{route('attr.index')}} "> <i class="fa fa-circle-o"></i>Product Attributes </a></li>
            @endcan
            @can('coupans.view')
            <li class="{{ Nav::isResource('coupan') }}"><a href="{{url('admin/coupan')}} "><i
                  class="fa fa-circle-o"></i>Coupons</a></li>
            @endcan
            @can('returnpolicy.view')
            <li class="{{ Nav::isResource('admin/return-policy') }}"><a href="{{url('admin/return-policy')}} "><i
                  class="fa fa-circle-o"></i>Return Policy Settings</a></li>
            @endcan
            @can('units.view')
            <li class="{{ Nav::isResource('unit') }}"><a href="{{url('admin/unit') }}"><i
                  class="fa fa-circle-o"></i>Units</a></li>
            @endcan
            @can('specialoffer.view')
            <li class="{{ Nav::isResource('special') }}"><a href="{{ url('admin/special') }}"><i
                  class="fa fa-circle-o"></i>Special Offers</a></li>
            @endcan

            @can('review.view')
              <li class="{{ Nav::isRoute('review.index') }}"><a href="{{url('admin/review')}}"><i
                class="fa fa-circle-o"></i>All Reviews</a></li>
          
              <li class="{{ Nav::isRoute('r.ap') }}"><a href="{{url('admin/review_approval')}}"><i
                class="fa fa-circle-o"></i>Reviews For Approval</a></li>
            @endcan

            @can('commission.manage')
            
                @if($cms->type =='c')
                <li class="{{ Nav::isResource('admin/commission') }}"><a href="{{url('admin/commission')}} "><i
                      class="fa fa-circle-o"></i>Commissions</a></li>
                @endif
                <li class="{{ Nav::isResource('admin/commission_setting') }}"><a href="{{url('admin/commission_setting')}} "><i class="fa fa-circle-o"></i>Commission Setting</a></li>
              
            @endcan

          </ul>
        </li>
        @endcan

        @canany(['order.view','invoicesetting.view'])
        <li id="ordersm"
          class="treeview {{ Nav::isResource('admin.pending.orders') }} {{ Nav::isRoute('admin.can.order') }} {{ Nav::isRoute('return.order.show') }} {{ Nav::isRoute('return.order.detail') }} {{ Nav::isRoute('return.order.index') }} {{ Nav::isResource('order') }} {{ Nav::isResource('invoice') }}">

          <a href="#">
            <i class="fa fa-list-alt" aria-hidden="true"></i> <span>Orders & Invoices</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <ul class="treeview-menu">

            <li class="{{ Nav::isResource('order') }}"><a href="{{route('order.index')}} "><i
                  class="fa fa-circle-o"></i>All Orders </a></li>
            <li class="{{ Nav::isResource('admin.pending.orders') }}"><a href="{{route('admin.pending.orders')}} "><i
                  class="fa fa-circle-o"></i>Pending Orders </a></li>
            <li class="{{ Nav::isRoute('admin.can.order') }}"><a href="{{route('admin.can.order')}} "><i
                  class="fa fa-circle-o"></i>Canceled Orders </a></li>

            <li
              class="{{ Nav::isRoute('return.order.index') }} {{ Nav::isRoute('return.order.show') }} {{ Nav::isRoute('return.order.detail') }}">
              <a href="{{route('return.order.index')}} "><i class="fa fa-circle-o"></i>Returned Orders </a></li>
            @can('invoicesetting.view')
            <li class="{{ Nav::isResource('invoice') }}"><a href="{{url('admin/invoice')}} "><i
                  class="fa fa-circle-o"></i>Invoice Setting</a></li>
            @endcan
          </ul>
        </li>
        @endcan

        @canany(['hotdeals.view','blockadvertisments.view','advertisements.view','testimonials.view','offerpopup.setting','pushnotification.settings'])
        <li id="martools"
          class="treeview {{ Nav::isRoute('admin.push.noti.settings') }} {{ Nav::isRoute('offer.get.settings') }} {{ Nav::isResource('admin/testimonial') }} {{ Nav::isResource('admin/adv') }} {{ Nav::isResource('admin/hotdeal') }} {{ Nav::isResource('admin/detailadvertise') }}">
          <a href="#">
            <i class="fa fa-line-chart" aria-hidden="true"></i><span>Marketing Tools</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <ul class="treeview-menu">
            @can('hotdeals.view')
              <li class="{{ Nav::isResource('admin/hotdeal') }}"><a href="{{url('admin/hotdeal')}}"><i
                  class="fa fa-circle-o"></i>Hot Deals</a></li>
            @endcan
            @can('blockadvertisments.view')
            <li class="{{ Nav::isResource('admin/detailadvertise') }}"><a href="{{url('admin/detailadvertise')}}"><i
                  class="fa fa-circle-o"></i>Block Advertisments</a></li>
            @endcan
            @can('advertisements.view')
            <li class="{{ Nav::isResource('admin/adv') }}"><a href="{{url('admin/adv')}}"><i
                  class="fa fa-circle-o"></i>Advertisements</a></li>
            @endcan
            @can('testimonials.view')
            <li class="{{ Nav::isResource('admin/testimonial') }}"><a href="{{url('admin/testimonial')}} "><i
                  class="fa fa-circle-o"></i>Testimonials</a></li>
            @endcan
            @can('offerpopup.setting')
            <li class="{{ Nav::isRoute('offer.get.settings') }}"><a href="{{route('offer.get.settings')}} "><i
                    class="fa fa-circle-o"></i>Offer PopUp Settings</a></li>
            @endcan
            @can('pushnotification.settings')
            <li class="{{ Nav::isRoute('admin.push.noti.settings') }}"><a href="{{route('admin.push.noti.settings')}} "><i class="fa fa-circle-o"></i>Push Notifications</a></li>
            @endcan
          </ul>

        </li>
        @endcan

        @can('location.manage')
        <li id="location"
          class="treeview {{ Nav::isRoute('country.list.pincode') }} {{ Nav::isRoute('admin.desti') }} {{ Nav::isRoute('country.index') }} {{ Nav::isRoute('state.index') }} {{ Nav::isRoute('city.index') }}">
          <a href="#">
            <i class="fa fa-map-marker" aria-hidden="true"></i> <span>Locations</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>


          <ul class="treeview-menu">
            <li class="{{ Nav::isResource('country') }}"><a href="{{url('admin/country')}}"><i
                  class="fa fa-circle-o"></i>Countries</a></li>
            <li class="{{ Nav::isResource('state') }}"><a href="{{url('admin/state')}}"><i
                  class="fa fa-circle-o"></i>States</a></li>
            <li class="{{ Nav::isResource('city') }}"><a href="{{url('admin/city')}}"><i
                  class="fa fa-circle-o"></i>Cities</a></li>
            <li class="{{ Nav::isRoute('country.list.pincode') }}{{ Nav::isRoute('admin.desti') }}"><a
                href="{{url('admin/destination')}}"><i class="fa fa-circle-o"></i>Delivery Locations</a></li>
          </ul>



        </li>
        @endcan
        @canany(['shipping.manage','taxsystem.manage'])
        <li id="shippingtax"
          class="treeview {{ Nav::isResource('admin/zone') }}  {{ Nav::isResource('shipping') }} {{ Nav::isResource('tax') }}">
          @can('shipping.manage')
          <a href="#">
            <i class="fa fa-fighter-jet" aria-hidden="true"></i> <span>Shipping & Taxes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          @endcan
          @can('taxsystem.manage')
          <ul class="treeview-menu">
            <li class="{{  Nav::isResource('tax_class')  }}"><a href="{{url('admin/tax_class')}}"><i
                  class="fa fa-circle-o"></i>Tax Classes</a></li>
            <li class="{{ Nav::isRoute('tax.index') }}{{ Nav::isRoute('tax.edit') }}{{ Nav::isRoute('tax.create') }}"><a
                href="{{url('admin/tax')}}"><i class="fa fa-circle-o"></i>Tax Rates</a></li>
            <li class="{{ Nav::isResource('admin/zone') }}"><a href="{{url('admin/zone')}}"><i
                  class="fa fa-circle-o"></i>Zones</a></li>
            <li class="{{ Nav::isResource('shipping') }}"><a href="{{url('admin/shipping')}}"><i
                  class="fa fa-circle-o"></i>Shipping</a></li>
          </ul>
          @endcan
        </li>
        @endcan

        

        @if($genrals_settings->vendor_enable == 1)
        @can('sellerpayout.manage')
        <li
          class="treeview {{ Nav::isRoute('seller.payout.show.complete') }} {{ Nav::isRoute('seller.payouts.index') }} {{ Nav::isRoute('seller.payout.complete') }}">
          <a href="#">
            <i class="fa fa-slack" aria-hidden="true"></i><span>Seller Payouts</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <li class="{{ Nav::isRoute('seller.payouts.index') }}"><a href="{{route('seller.payouts.index')}} "><i
                  class="fa fa-circle-o"></i>Pending Payouts</a></li>

            <li class="{{ Nav::isRoute('seller.payout.show.complete') }} {{ Nav::isRoute('seller.payout.complete') }}">
              <a href="{{ route('seller.payout.complete') }}"><i class="fa fa-circle-o"></i>Completed Payouts</a></li>

          </ul>

        </li>

        @endcan

        @endif



        @can('currency.manage')
        <li id="mscur" class="{{ Nav::isResource('admin/multiCurrency') }}"><a href="{{url('admin/multiCurrency')}} "><i
              class="fa fa-money"></i><span>Currency settings</span></a></li>
        @endcan

        

        @if(extended_license() == true && env('ENABLE_SELLER_SUBS_SYSTEM') == 1)
        @can('sellersubscription.manage')
          <li class="treeview {{ Nav::isRoute('seller.subs.listofsubs') }} {{ Nav::isResource('subscription-vouchers') }} {{ Nav::isResource('plans') }}">
            <a href="#"><i class="fa fa-credit-card"></i>
              <span>
                {{__("Seller Subscriptions")}}
              </span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                <small class="label pull-right bg-red">NEW</small>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{ Nav::isResource('plans') }}">
                <a href="{{route('seller.subs.plans.index')}} "><i
                    class="fa fa-circle-o"></i> {{__("Packages")}}
                </a>
              </li>
              <li class="{{ Nav::isResource('subscription-vouchers') }}">
                <a href="{{route('subscription-vouchers.index')}} "><i
                    class="fa fa-circle-o"></i> {{__("Subscription vouchers")}}
                </a>
              </li>
              <li class="{{ Nav::isRoute('seller.subs.listofsubs') }}">
                <a href="{{ route('seller.subs.listofsubs') }}">
                  <i class="fa fa-circle-o" aria-hidden="true"></i><span>{{__("Subscribers List")}}</span>
                </a>
              </li>
            </ul>
          </li>
          @endcan
        @endif

        @can('affiliatesystem.manage')
          <li id="slider" class="treeview {{ Nav::isRoute('admin.affilate.settings') }} {{ Nav::isRoute('admin.affilate.dashboard') }}">
            <a href="#">
              <i class="fa fa-asterisk"></i><span>
                {{__("Affiliate Manager")}}
              </span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                <small class="label pull-right bg-red">NEW</small>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{ Nav::isRoute('admin.affilate.settings') }}">
                <a href="{{route('admin.affilate.settings')}} "><i
                    class="fa fa-circle-o"></i> {{__("Affiliate Settings")}}
                </a>
              </li>
              @if($aff_system->enable_affilate == 1)
              <li class="{{ Nav::isRoute('admin.affilate.dashboard') }}">
                <a href="{{route('admin.affilate.dashboard')}} ">
                  <i class="fa fa-circle-o" aria-hidden="true"></i><span>{{__("Affiliate Reports")}}</span>
                </a>
              </li>
              @endif
            </ul>
          </li>
        @endcan

       
        @canany(['pages.view','blog.view','site-settings.style-settings','site-settings.footer-customize','site-settings.social-handle','pwa.setting.index','color-options.manage','faq.view','widget-settings.manage','payment-gateway.manage','manual-payment.view','sliders.manage'])
        <li class="treeview {{ Nav::isResource('page') }} {{ Nav::isResource('blog') }} {{ Nav::isResource('social') }} {{ Nav::isRoute('footer.index') }} {{ Nav::isRoute('customstyle') }} {{ Nav::isRoute('front.slider') }} {{ Nav::isResource('slider') }} {{ Nav::isRoute('payment.gateway.settings') }} {{ Nav::isRoute('manual.payment.gateway') }} {{ Nav::isRoute('widget.setting') }} {{ Nav::isResource('faq') }} {{ Nav::isRoute('admin.theme.index') }} {{ Nav::isRoute('pwa.setting.index') }}">
            <a href="#">
              <i class="fa fa-users" aria-hidden="true"></i> <span>{{ __("Front Settings") }}</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>

            <ul class="treeview-menu">
              
              @can('sliders.manage')
                <li id="slider" class="treeview {{ Nav::isRoute('front.slider') }} {{ Nav::isResource('slider') }}">
                  <a href="#">
                    <i class="fa fa-circle-o" aria-hidden="true"></i><span>Sliders</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li class="{{ Nav::isResource('slider') }}"><a href="{{url('admin/slider')}} "><i
                          class="fa fa-circle-o"></i>Sliders</a></li>
                    <li class="{{ Nav::isRoute('front.slider') }}">
                      <a href="{{route('front.slider')}} "><i class="fa fa-circle-o" aria-hidden="true"></i><span>Top Category Slider</span></a>
                    </li>
                  </ul>
                </li>
              @endcan

              @can('pwasettings.manage')
                <li class="{{ Nav::isRoute('pwa.setting.index') }}"><a title="Progressive Web App Setting"
                    href="{{route('pwa.setting.index')}} "><i class="fa fa-circle-o" aria-hidden="true"></i><span>PWA Settings</span></a>
                </li>
              @endcan

              @can('color-options.manage')
                <li id="theme-settings" class="{{ Nav::isRoute('admin.theme.index') }}">
                  <a href="{{ route('admin.theme.index') }}">
                    <i class="fa fa-circle-o" aria-hidden="true"></i><span>Color Options</span>
                  </a>
                </li>
              @endcan

              @can('faq.view')
                <li id="faqs" class="{{ Nav::isResource('faq') }}"><a href="{{url('admin/faq')}} ">
                    <i class="fa fa-circle-o" aria-hidden="true"></i><span>FAQ's</span></a>
                </li>
              @endcan

              @can('widget-settings.manage')

                <li class="{{ Nav::isRoute('widget.setting') }}">

                  <a href="{{ route('widget.setting') }}"><i class="fa fa-circle-o"></i><span>Widgets Settings</span></span></a>

                </li>

              @endcan

              @can('payment-gateway.manage')
                <li class="{{ Nav::isRoute('payment.gateway.settings') }}">

                  <a href="{{ route('payment.gateway.settings') }}"><i class="fa fa-circle-o"></i><span>Payment Gateway
                      Settings</span></a>

                </li>
              @endcan

              @can('manual-payment.view')
                <li class="{{ Nav::isRoute('manual.payment.gateway') }}">

                  <a href="{{ route('manual.payment.gateway') }}"><i class="fa fa-circle-o"></i><span>Offline Payment Gateway</span></a>

                </li>
              @endcan

              @can('site-settings.style-settings')
                <li class="{{ Nav::isRoute('customstyle') }}">
                  <a href="{{ route('customstyle') }}">
                    <i class="fa fa-circle-o" aria-hidden="true"></i><span>Custom Style and JS</span></a>
                </li>
              @endcan

              @can('site-settings.footer-customize')
                <li class="{{ Nav::isRoute('footer.index') }}"><a href="{{url('admin/footer')}} "><i
                    class="fa fa-circle-o"></i>Footer Customizations</a></li>
              @endcan
              
              @can('site-settings.social-handle')
                <li class="{{ Nav::isResource('social') }}"><a href="{{url('admin/social')}} "><i
                    class="fa fa-circle-o"></i>Social Handler Settings</a></li>
              @endcan
              
              @can('blog.view')
                <li class="{{ Nav::isResource('blog') }}"><a href="{{url('admin/blog')}}"><i
                    class="fa fa-circle-o"></i>Blogs</a></li>
              @endcan

              @can('pages.view')
                <li class="{{ Nav::isResource('page') }}"><a href="{{url('admin/page')}}"><i
                  class="fa fa-circle-o"></i>Pages</a>
                </li>
              @endcan
              
            </ul>
        </li>
        @endcan

        @canany(['terms-settings.update','others.abuse-word-manage','site-settings.bank-settings','site-settings.dashboard-settings','site-settings.footer-customize','site-settings.genral-settings','site-settings.genral-settings','site-settings.language','site-settings.mail-settings','site-settings.maintenance-mode','site-settings.sms-settings','site-settings.social-handle','site-settings.social-login-settings','site-settings.style-settings'])
        <li id="sitesetting"
          class="treeview {{ Nav::isRoute('get.user.terms') }} {{ Nav::isRoute('sms.settings') }} {{ Nav::isRoute('get.view.m.mode') }} {{ Nav::isRoute('site.lang') }} {{ Nav::isResource('admin/abuse') }} {{ Nav::isResource('admin/bank_details') }} {{ Nav::isRoute('genral.index') }} {{ Nav::isRoute('mail.getset') }} {{ Nav::isRoute('gen.set') }} {{ Nav::isResource('page') }}  {{ Nav::isRoute('seo.index') }} {{ Nav::isRoute('api.setApiView') }} {{ Nav::isRoute('get.paytm.setting') }} {{ Nav::isResource('page') }} {{ Nav::isRoute('admin.dash') }} {{ Nav::isRoute('static.trans')  }}">
          <a href="#">
            <i class="fa fa-cog" aria-hidden="true"></i><span>Site Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            @can('site-settings.genral-settings')
            <li class="{{ Nav::isRoute('genral.index') }}"><a href="{{url('admin/genral')}}"><i
                  class="fa fa-circle-o"></i>General Settings</a></li>
            @endcan

            @can('seo.manage')
            <li class="{{ Nav::isRoute('seo.index') }}"><a href="{{url('admin/seo')}} "><i
                  class="fa fa-circle-o"></i>SEO</a></li>
            @endcan

            @can('site-settings.language')
            <li class="{{ Nav::isRoute('static.trans')  }} {{ Nav::isRoute('site.lang') }}"><a
                href="{{route('site.lang')}}"><i class="fa fa-circle-o"></i>Site Languages</a></li>
            @endcan

            @can('site-settings.mail-settings')
            <li class="{{ Nav::isRoute('mail.getset') }}"><a href="{{url('admin/mail-settings')}}"><i
                  class="fa fa-circle-o"></i>Mail Settings</a></li>
            @endcan

            @can('site-settings.social-login-settings')
            <li class="{{ Nav::isRoute('gen.set') }}"><a href="{{route('gen.set')}}"><i
                  class="fa fa-circle-o"></i>Social Login Settings</a></li>
            @endcan
            
            @can('site-settings.sms-settings')
            <li class="{{ Nav::isRoute('sms.settings') }}"><a href="{{route('sms.settings')}}"><i
                    class="fa fa-circle-o"></i>SMS Settings</a></li>
            @endcan

            @can('site-settings.dashboard-settings')
              <li class="{{ Nav::isRoute('admin.dash') }}">
                <a href="{{ route('admin.dash') }}">
                  <i class="fa fa-circle-o" aria-hidden="true"></i><span>Admin Dashboard Settings</span></a>
              </li>
            @endcan

            @can('site-settings.maintenance-mode')
              <li class="{{ Nav::isRoute('get.view.m.mode') }}">
                <a href="{{ route('get.view.m.mode') }}">
                  <i class="fa fa-circle-o" aria-hidden="true"></i><span>Maintenance Mode</span></a>
              </li>
            @endcan

            @can('terms-settings.update')
              <li id="sitesetting" class="{{ Nav::isRoute('get.user.terms') }}">
                <a href="{{ route('get.user.terms') }}">
                  <i class="fa fa-circle-o" aria-hidden="true"></i><span>Terms Pages</span>
                </a>
              </li>
            @endcan

            @can('site-settings.bank-settings')
            <li class="{{ Nav::isResource('admin/bank_details') }}"><a href="{{url('admin/bank_details')}} "><i
                  class="fa fa-circle-o" aria-hidden="true"></i><span>Bank Details</span></a></li>
            @endcan

            
            @can('others.abuse-word-manage')
            <li class="{{ Nav::isResource('admin/abuse') }}">
              <a href="{{ url('admin/abuse') }}">
                <i class="fa fa-circle-o" aria-hidden="true"></i><span>Abuse Word Settings</span></a>
            </li>
            @endcan
          </ul>
        </li>

        @endcan

       
        

        
        
        

        
        @can('wallet.manage')
        <li class="{{ Nav::isRoute('admin.wallet.settings') }}"><a href="{{ route('admin.wallet.settings') }}"><i
              class="fa fa-folder" aria-hidden="true"></i><span>Wallet</span></a></li>
        @endcan

        @can('support-ticket.manage')

        <li id="ticket" class="{{ Nav::isRoute('tickets.admin') }} {{ Nav::isRoute('ticket.show') }}">
          <a href="{{ route('tickets.admin') }}">
            <i class="fa fa-bullhorn" aria-hidden="true"></i>
            <span>Support Tickets</span></a>
        </li>

        @endcan

        @can('reported-products.view')
        <li id="reppro" class="{{ Nav::isRoute('get.rep.pro') }}">
          <a href="{{ route('get.rep.pro') }}">
            <i class="fa fa-flag" aria-hidden="true"></i> <span>Reported Products</span></a>
        </li>
        @endcan

        @can('addon-manager.manage')
        <li class="{{ Nav::isRoute('addonmanger.index') }}"><a title="Progressive Web App Setting"
          href="{{route('addonmanger.index')}} "><i class="fa fa-arrow-circle-o-down"></i>
          <span>{{ __("Add-on Manager") }} <small class="label pull-right bg-red">NEW</small></span> </a></li>
        @endcan
        @can('reports.view')
        <li class="treeview {{ Nav::isRoute('admin.report.mostviewed') }} {{ Nav::isRoute('admin.stock.report') }} {{ Nav::isRoute('admin.sales.report') }}">
          <a href="#">
            <i class="fa fa-file-text-o"></i> <span>Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <li class="{{ Nav::isRoute('admin.stock.report') }}">
              <a href="{{ route('admin.stock.report') }}">
                <i class="fa fa-circle-o"></i> <span>{{__("Stock Report")}}</span>
              </a>
            </li>

            <li class="{{ Nav::isRoute('admin.sales.report') }}">
              <a href="{{ route('admin.sales.report') }}">
                <i class="fa fa-circle-o"></i> <span>{{__("Sales Report")}}</span>
              </a>
            </li>

            <li class="{{ Nav::isRoute('admin.report.mostviewed') }}">
              <a href="{{ route('admin.report.mostviewed') }}">
                <i class="fa fa-circle-o"></i> <span>{{__("Most viewed products")}}</span>
              </a>
            </li>

          </ul>
        </li>
        @endcan

        @canany(['others.importdemo','others.database-backup','others.systemstatus'])
        <li class="treeview {{ Nav::isRoute('others.settings') }} {{ Nav::isRoute('systemstatus') }} {{ Nav::isRoute('admin.import.demo') }} {{ Nav::isRoute('admin.backup.settings') }}">
          <a href="#">
            <i class="fa fa-question-circle" aria-hidden="true"></i><span>Help & Support</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            
            @can('others.importdemo')
            <li class="{{ Nav::isRoute('admin.import.demo') }}">
              <a href="{{ url('/admin/import-demo') }}">
                <i class="fa fa-circle-o"></i> <span>Import Demo</span></a>
            </li>
            @endcan

            @can('others.database-backup')
            <li id="reppro" class="{{ Nav::isRoute('admin.backup.settings') }}">
              <a href="{{ route('admin.backup.settings') }}">
                <i class="fa fa-circle-o"></i> <span>Database Backup</span></a>
            </li>
            @endcan

            @can('others.systemstatus')
              <li class="{{ Nav::isRoute('systemstatus') }}">
                <a href="{{ route('systemstatus') }}">
                  <i class="fa fa-circle-o"></i> <span>System Status</span>
                </a>
              </li>
            @endcan

            @if(auth()->user()->getRoleNames()->contains('Super Admin'))
              <li class="{{ Nav::isRoute('others.settings') }}">
                <a href="{{ route('others.settings') }}">
                  <i class="fa fa-circle-o"></i> <span>Remove Public & Force HTTPS</span>
                </a>
              </li>
            @endif

          </ul>
        </li>
        @endcan

        <li >
          <a href="{{ url('clear-cache') }}">
            <i class="fa fa-rocket"></i> <span>Clear Cache</span>
          </a>
        </li>
        

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>