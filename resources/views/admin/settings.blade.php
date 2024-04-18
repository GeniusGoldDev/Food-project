@extends('admin.layouts.master')
@section("title") Settings - Dashboard
@endsection
@section('content')
<style>
    .disable-switch {
    opacity: 0.5;
    pointer-events: none;
    }
</style>
<div class="page-header">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-circle-right2 mr-2"></i>
                <span class="font-weight-bold mr-2">SETTINGS</span>
            </h4>
        </div>
    </div>
</div>
<div class="content">
    <div class="col-md-12">
        <div class="card" style="min-height: 100vh;">
            <div class="card-body">
                <form action="{{ route('admin.saveSettings') }}" method="POST" enctype="multipart/form-data">
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary btn-labeled btn-labeled-left btn-lg">
                        <b><i class="icon-database-insert ml-1"></i></b>
                        Save Settings
                        </button>
                    </div>
                    <div class="d-lg-flex justify-content-lg-left">
                        <ul class="nav nav-pills flex-column mr-lg-3 wmin-lg-250 mb-lg-0">
                            <li class="nav-item">
                                <a href="#generalSettings" class="nav-link active" data-toggle="tab">
                                <i class="icon-gear mr-2 custom-color-{{ rand(1,8) }} settings-icon"></i>
                                General
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#designSettings" class="nav-link" data-toggle="tab">
                                <i class="icon-brush mr-2 custom-color-{{ rand(1,8) }} settings-icon"></i>
                                Design
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#customerAppSettings" class="nav-link" data-toggle="tab">
                                <i class="icon-users4 mr-2 custom-color-{{ rand(1,8) }} settings-icon"></i>
                                Customer Application
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#deliveryAppSettings" class="nav-link" data-toggle="tab">
                                <i class="icon-truck mr-2 custom-color-{{ rand(1,8) }} settings-icon"></i>
                                Delivery Application
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#restaurantDashboardSettings" class="nav-link" data-toggle="tab">
                                <i class="icon-user-tie mr-2 custom-color-{{ rand(1,8) }} settings-icon"></i>
                                Store Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#seoSettings" class="nav-link" data-toggle="tab">
                                <i class="icon-zoomin3 mr-2 custom-color-{{ rand(1,8) }} settings-icon"></i>
                                SEO
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#pushNotificationSettings" class="nav-link" data-toggle="tab">
                                <i class="icon-bubble-dots4 mr-2 custom-color-{{ rand(1,8) }} settings-icon"></i>
                                Push Notifications
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#socialLoginSettings" class="nav-link" data-toggle="tab">
                                <i class="icon-feed2 mr-2 custom-color-{{ rand(1,8) }} settings-icon"></i>
                                Social Login
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#mapSettings" class="nav-link" data-toggle="tab">
                                <i class="icon-location4 mr-2 custom-color-{{ rand(1,8) }} settings-icon"></i>
                                Google Maps
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#paymentGatewaySettings" class="nav-link" data-toggle="tab">
                                <i class="icon-coin-dollar mr-2 custom-color-{{ rand(1,8) }} settings-icon"></i>
                                Payment Gateways
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#smsGatewaySettings" class="nav-link" data-toggle="tab">
                                <i class="icon-bubble-lines4 mr-2 custom-color-{{ rand(1,8) }} settings-icon"></i>
                                SMS Settings
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#emailSettings" class="nav-link" data-toggle="tab">
                                <i class="icon-envelop3 mr-2 custom-color-{{ rand(1,8) }} settings-icon"></i>
                                Email Settings 
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#googleAnalyticsSettings" class="nav-link" data-toggle="tab">
                                <i class="icon-graph mr-2 custom-color-{{ rand(1,8) }} settings-icon"></i>
                                Google Analytics
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#taxSettings" class="nav-link" data-toggle="tab">
                                <i class="icon-percent mr-2 custom-color-{{ rand(1,8) }} settings-icon"></i>
                                Tax Settings
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.translations') }}" class="nav-link">
                                <i class="icon-font-size2 mr-2 custom-color-{{ rand(1,8) }} settings-icon"></i>
                                Translations
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#customCSS" class="nav-link" data-toggle="tab">
                                <i class="icon-file-css mr-2 custom-color-{{ rand(1,8) }} settings-icon"></i>
                                Custom CSS
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#cacheSettings" class="nav-link" data-toggle="tab">
                                <i class="icon-database-refresh mr-2 custom-color-{{ rand(1,8) }} settings-icon"></i>
                                Cache Settings
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#fixUpdateIssues" class="nav-link" data-toggle="tab">
                                <i class="icon-magic-wand2 mr-2 custom-color-{{ rand(1,8) }} settings-icon"></i>
                                Fix Update Issues
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#advanceSettings" class="nav-link" data-toggle="tab">
                                <i class="icon-user-tie mr-2 custom-color-{{ rand(1,8) }} settings-icon"></i>
                                Advanced Settings
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" style="width: 100%; padding: 0 25px;">
                            <div class="tab-pane fade show active" id="generalSettings">
                                <legend class="font-weight-semibold text-uppercase font-size-sm">
                                    Website's General Settings
                                </legend>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Store Name:</strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="storeName"
                                            value="{{ config('appSettings.storeName') }}" placeholder="Enter Store Name">
                                        <span class="help-text small"> To change the Progressive Web Application names, refer to this <a href="https://docs.foodomaa.com/configurations/pwa-configurations" target="_blank">documentation</a></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Website URL:</strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="storeUrl"
                                            value="{{ config('appSettings.storeUrl') }}"
                                            placeholder="Enter website URL like: https://yourdomain.com">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">
                                    <strong>Application Time Zone:</strong>
                                    </label>
                                    <div class="col-lg-9">
                                        <select name="timezone" class="form-control form-control-lg timezone-select select">
                                            <optgroup label="General">
                                                <option value="GMT">GMT timezone</option>
                                                <option value="UTC">UTC timezone</option>
                                            </optgroup>
                                            <optgroup label="Africa">
                                                <option value="Africa/Abidjan">(GMT/UTC + 00:00) Abidjan</option>
                                                <option value="Africa/Accra">(GMT/UTC + 00:00) Accra</option>
                                                <option value="Africa/Addis_Ababa">(GMT/UTC + 03:00) Addis Ababa
                                                </option>
                                                <option value="Africa/Algiers">(GMT/UTC + 01:00) Algiers</option>
                                                <option value="Africa/Asmara">(GMT/UTC + 03:00) Asmara</option>
                                                <option value="Africa/Bamako">(GMT/UTC + 00:00) Bamako</option>
                                                <option value="Africa/Bangui">(GMT/UTC + 01:00) Bangui</option>
                                                <option value="Africa/Banjul">(GMT/UTC + 00:00) Banjul</option>
                                                <option value="Africa/Bissau">(GMT/UTC + 00:00) Bissau</option>
                                                <option value="Africa/Blantyre">(GMT/UTC + 02:00) Blantyre</option>
                                                <option value="Africa/Brazzaville">(GMT/UTC + 01:00) Brazzaville
                                                </option>
                                                <option value="Africa/Bujumbura">(GMT/UTC + 02:00) Bujumbura</option>
                                                <option value="Africa/Cairo">(GMT/UTC + 02:00) Cairo</option>
                                                <option value="Africa/Casablanca">(GMT/UTC + 00:00) Casablanca</option>
                                                <option value="Africa/Ceuta">(GMT/UTC + 01:00) Ceuta</option>
                                                <option value="Africa/Conakry">(GMT/UTC + 00:00) Conakry</option>
                                                <option value="Africa/Dakar">(GMT/UTC + 00:00) Dakar</option>
                                                <option value="Africa/Dar_es_Salaam">(GMT/UTC + 03:00) Dar es Salaam
                                                </option>
                                                <option value="Africa/Djibouti">(GMT/UTC + 03:00) Djibouti</option>
                                                <option value="Africa/Douala">(GMT/UTC + 01:00) Douala</option>
                                                <option value="Africa/El_Aaiun">(GMT/UTC + 00:00) El Aaiun</option>
                                                <option value="Africa/Freetown">(GMT/UTC + 00:00) Freetown</option>
                                                <option value="Africa/Gaborone">(GMT/UTC + 02:00) Gaborone</option>
                                                <option value="Africa/Harare">(GMT/UTC + 02:00) Harare</option>
                                                <option value="Africa/Johannesburg">(GMT/UTC + 02:00) Johannesburg
                                                </option>
                                                <option value="Africa/Juba">(GMT/UTC + 03:00) Juba</option>
                                                <option value="Africa/Kampala">(GMT/UTC + 03:00) Kampala</option>
                                                <option value="Africa/Khartoum">(GMT/UTC + 03:00) Khartoum</option>
                                                <option value="Africa/Kigali">(GMT/UTC + 02:00) Kigali</option>
                                                <option value="Africa/Kinshasa">(GMT/UTC + 01:00) Kinshasa</option>
                                                <option value="Africa/Lagos">(GMT/UTC + 01:00) Lagos</option>
                                                <option value="Africa/Libreville">(GMT/UTC + 01:00) Libreville</option>
                                                <option value="Africa/Lome">(GMT/UTC + 00:00) Lome</option>
                                                <option value="Africa/Luanda">(GMT/UTC + 01:00) Luanda</option>
                                                <option value="Africa/Lubumbashi">(GMT/UTC + 02:00) Lubumbashi</option>
                                                <option value="Africa/Lusaka">(GMT/UTC + 02:00) Lusaka</option>
                                                <option value="Africa/Malabo">(GMT/UTC + 01:00) Malabo</option>
                                                <option value="Africa/Maputo">(GMT/UTC + 02:00) Maputo</option>
                                                <option value="Africa/Maseru">(GMT/UTC + 02:00) Maseru</option>
                                                <option value="Africa/Mbabane">(GMT/UTC + 02:00) Mbabane</option>
                                                <option value="Africa/Mogadishu">(GMT/UTC + 03:00) Mogadishu</option>
                                                <option value="Africa/Monrovia">(GMT/UTC + 00:00) Monrovia</option>
                                                <option value="Africa/Nairobi">(GMT/UTC + 03:00) Nairobi</option>
                                                <option value="Africa/Ndjamena">(GMT/UTC + 01:00) Ndjamena</option>
                                                <option value="Africa/Niamey">(GMT/UTC + 01:00) Niamey</option>
                                                <option value="Africa/Nouakchott">(GMT/UTC + 00:00) Nouakchott</option>
                                                <option value="Africa/Ouagadougou">(GMT/UTC + 00:00) Ouagadougou
                                                </option>
                                                <option value="Africa/Porto-Novo">(GMT/UTC + 01:00) Porto-Novo</option>
                                                <option value="Africa/Sao_Tome">(GMT/UTC + 00:00) Sao Tome</option>
                                                <option value="Africa/Tripoli">(GMT/UTC + 02:00) Tripoli</option>
                                                <option value="Africa/Tunis">(GMT/UTC + 01:00) Tunis</option>
                                                <option value="Africa/Windhoek">(GMT/UTC + 02:00) Windhoek</option>
                                            </optgroup>
                                            <optgroup label="America">
                                                <option value="America/Adak">(GMT/UTC - 10:00) Adak</option>
                                                <option value="America/Anchorage">(GMT/UTC - 09:00) Anchorage</option>
                                                <option value="America/Anguilla">(GMT/UTC - 04:00) Anguilla</option>
                                                <option value="America/Antigua">(GMT/UTC - 04:00) Antigua</option>
                                                <option value="America/Araguaina">(GMT/UTC - 03:00) Araguaina</option>
                                                <option value="America/Argentina/Buenos_Aires">(GMT/UTC - 03:00)
                                                    Argentina/Buenos Aires
                                                </option>
                                                <option value="America/Argentina/Catamarca">(GMT/UTC - 03:00)
                                                    Argentina/Catamarca
                                                </option>
                                                <option value="America/Argentina/Cordoba">(GMT/UTC - 03:00)
                                                    Argentina/Cordoba
                                                </option>
                                                <option value="America/Argentina/Jujuy">(GMT/UTC - 03:00)
                                                    Argentina/Jujuy
                                                </option>
                                                <option value="America/Argentina/La_Rioja">(GMT/UTC - 03:00)
                                                    Argentina/La Rioja
                                                </option>
                                                <option value="America/Argentina/Mendoza">(GMT/UTC - 03:00)
                                                    Argentina/Mendoza
                                                </option>
                                                <option value="America/Argentina/Rio_Gallegos">(GMT/UTC - 03:00)
                                                    Argentina/Rio Gallegos
                                                </option>
                                                <option value="America/Argentina/Salta">(GMT/UTC - 03:00)
                                                    Argentina/Salta
                                                </option>
                                                <option value="America/Argentina/San_Juan">(GMT/UTC - 03:00)
                                                    Argentina/San Juan
                                                </option>
                                                <option value="America/Argentina/San_Luis">(GMT/UTC - 03:00)
                                                    Argentina/San Luis
                                                </option>
                                                <option value="America/Argentina/Tucuman">(GMT/UTC - 03:00)
                                                    Argentina/Tucuman
                                                </option>
                                                <option value="America/Argentina/Ushuaia">(GMT/UTC - 03:00)
                                                    Argentina/Ushuaia
                                                </option>
                                                <option value="America/Aruba">(GMT/UTC - 04:00) Aruba</option>
                                                <option value="America/Asuncion">(GMT/UTC - 03:00) Asuncion</option>
                                                <option value="America/Atikokan">(GMT/UTC - 05:00) Atikokan</option>
                                                <option value="America/Bahia">(GMT/UTC - 03:00) Bahia</option>
                                                <option value="America/Bahia_Banderas">(GMT/UTC - 06:00) Bahia Banderas
                                                </option>
                                                <option value="America/Barbados">(GMT/UTC - 04:00) Barbados</option>
                                                <option value="America/Belem">(GMT/UTC - 03:00) Belem</option>
                                                <option value="America/Belize">(GMT/UTC - 06:00) Belize</option>
                                                <option value="America/Blanc-Sablon">(GMT/UTC - 04:00) Blanc-Sablon
                                                </option>
                                                <option value="America/Boa_Vista">(GMT/UTC - 04:00) Boa Vista</option>
                                                <option value="America/Bogota">(GMT/UTC - 05:00) Bogota</option>
                                                <option value="America/Boise">(GMT/UTC - 07:00) Boise</option>
                                                <option value="America/Cambridge_Bay">(GMT/UTC - 07:00) Cambridge Bay
                                                </option>
                                                <option value="America/Campo_Grande">(GMT/UTC - 03:00) Campo Grande
                                                </option>
                                                <option value="America/Cancun">(GMT/UTC - 05:00) Cancun</option>
                                                <option value="America/Caracas">(GMT/UTC - 04:30) Caracas</option>
                                                <option value="America/Cayenne">(GMT/UTC - 03:00) Cayenne</option>
                                                <option value="America/Cayman">(GMT/UTC - 05:00) Cayman</option>
                                                <option value="America/Chicago">(GMT/UTC - 06:00) Chicago</option>
                                                <option value="America/Chihuahua">(GMT/UTC - 07:00) Chihuahua</option>
                                                <option value="America/Costa_Rica">(GMT/UTC - 06:00) Costa Rica</option>
                                                <option value="America/Creston">(GMT/UTC - 07:00) Creston</option>
                                                <option value="America/Cuiaba">(GMT/UTC - 03:00) Cuiaba</option>
                                                <option value="America/Curacao">(GMT/UTC - 04:00) Curacao</option>
                                                <option value="America/Danmarkshavn">(GMT/UTC + 00:00) Danmarkshavn
                                                </option>
                                                <option value="America/Dawson">(GMT/UTC - 08:00) Dawson</option>
                                                <option value="America/Dawson_Creek">(GMT/UTC - 07:00) Dawson Creek
                                                </option>
                                                <option value="America/Denver">(GMT/UTC - 07:00) Denver</option>
                                                <option value="America/Detroit">(GMT/UTC - 05:00) Detroit</option>
                                                <option value="America/Dominica">(GMT/UTC - 04:00) Dominica</option>
                                                <option value="America/Edmonton">(GMT/UTC - 07:00) Edmonton</option>
                                                <option value="America/Eirunepe">(GMT/UTC - 05:00) Eirunepe</option>
                                                <option value="America/El_Salvador">(GMT/UTC - 06:00) El Salvador
                                                </option>
                                                <option value="America/Fort_Nelson">(GMT/UTC - 07:00) Fort Nelson
                                                </option>
                                                <option value="America/Fortaleza">(GMT/UTC - 03:00) Fortaleza</option>
                                                <option value="America/Glace_Bay">(GMT/UTC - 04:00) Glace Bay</option>
                                                <option value="America/Godthab">(GMT/UTC - 03:00) Godthab</option>
                                                <option value="America/Goose_Bay">(GMT/UTC - 04:00) Goose Bay</option>
                                                <option value="America/Grand_Turk">(GMT/UTC - 04:00) Grand Turk</option>
                                                <option value="America/Grenada">(GMT/UTC - 04:00) Grenada</option>
                                                <option value="America/Guadeloupe">(GMT/UTC - 04:00) Guadeloupe</option>
                                                <option value="America/Guatemala">(GMT/UTC - 06:00) Guatemala</option>
                                                <option value="America/Guayaquil">(GMT/UTC - 05:00) Guayaquil</option>
                                                <option value="America/Guyana">(GMT/UTC - 04:00) Guyana</option>
                                                <option value="America/Halifax">(GMT/UTC - 04:00) Halifax</option>
                                                <option value="America/Havana">(GMT/UTC - 05:00) Havana</option>
                                                <option value="America/Hermosillo">(GMT/UTC - 07:00) Hermosillo</option>
                                                <option value="America/Indiana/Indianapolis">(GMT/UTC - 05:00)
                                                    Indiana/Indianapolis
                                                </option>
                                                <option value="America/Indiana/Knox">(GMT/UTC - 06:00) Indiana/Knox
                                                </option>
                                                <option value="America/Indiana/Marengo">(GMT/UTC - 05:00)
                                                    Indiana/Marengo
                                                </option>
                                                <option value="America/Indiana/Petersburg">(GMT/UTC - 05:00)
                                                    Indiana/Petersburg
                                                </option>
                                                <option value="America/Indiana/Tell_City">(GMT/UTC - 06:00) Indiana/Tell
                                                    City
                                                </option>
                                                <option value="America/Indiana/Vevay">(GMT/UTC - 05:00) Indiana/Vevay
                                                </option>
                                                <option value="America/Indiana/Vincennes">(GMT/UTC - 05:00)
                                                    Indiana/Vincennes
                                                </option>
                                                <option value="America/Indiana/Winamac">(GMT/UTC - 05:00)
                                                    Indiana/Winamac
                                                </option>
                                                <option value="America/Inuvik">(GMT/UTC - 07:00) Inuvik</option>
                                                <option value="America/Iqaluit">(GMT/UTC - 05:00) Iqaluit</option>
                                                <option value="America/Jamaica">(GMT/UTC - 05:00) Jamaica</option>
                                                <option value="America/Juneau">(GMT/UTC - 09:00) Juneau</option>
                                                <option value="America/Kentucky/Louisville">(GMT/UTC - 05:00)
                                                    Kentucky/Louisville
                                                </option>
                                                <option value="America/Kentucky/Monticello">(GMT/UTC - 05:00)
                                                    Kentucky/Monticello
                                                </option>
                                                <option value="America/Kralendijk">(GMT/UTC - 04:00) Kralendijk</option>
                                                <option value="America/La_Paz">(GMT/UTC - 04:00) La Paz</option>
                                                <option value="America/Lima">(GMT/UTC - 05:00) Lima</option>
                                                <option value="America/Los_Angeles">(GMT/UTC - 08:00) Los Angeles
                                                </option>
                                                <option value="America/Lower_Princes">(GMT/UTC - 04:00) Lower Princes
                                                </option>
                                                <option value="America/Maceio">(GMT/UTC - 03:00) Maceio</option>
                                                <option value="America/Managua">(GMT/UTC - 06:00) Managua</option>
                                                <option value="America/Manaus">(GMT/UTC - 04:00) Manaus</option>
                                                <option value="America/Marigot">(GMT/UTC - 04:00) Marigot</option>
                                                <option value="America/Martinique">(GMT/UTC - 04:00) Martinique</option>
                                                <option value="America/Matamoros">(GMT/UTC - 06:00) Matamoros</option>
                                                <option value="America/Mazatlan">(GMT/UTC - 07:00) Mazatlan</option>
                                                <option value="America/Menominee">(GMT/UTC - 06:00) Menominee</option>
                                                <option value="America/Merida">(GMT/UTC - 06:00) Merida</option>
                                                <option value="America/Metlakatla">(GMT/UTC - 09:00) Metlakatla</option>
                                                <option value="America/Mexico_City">(GMT/UTC - 06:00) Mexico City
                                                </option>
                                                <option value="America/Miquelon">(GMT/UTC - 03:00) Miquelon</option>
                                                <option value="America/Moncton">(GMT/UTC - 04:00) Moncton</option>
                                                <option value="America/Monterrey">(GMT/UTC - 06:00) Monterrey</option>
                                                <option value="America/Montevideo">(GMT/UTC - 03:00) Montevideo</option>
                                                <option value="America/Montserrat">(GMT/UTC - 04:00) Montserrat</option>
                                                <option value="America/Nassau">(GMT/UTC - 05:00) Nassau</option>
                                                <option value="America/New_York">(GMT/UTC - 05:00) New York</option>
                                                <option value="America/Nipigon">(GMT/UTC - 05:00) Nipigon</option>
                                                <option value="America/Nome">(GMT/UTC - 09:00) Nome</option>
                                                <option value="America/Noronha">(GMT/UTC - 02:00) Noronha</option>
                                                <option value="America/North_Dakota/Beulah">(GMT/UTC - 06:00) North
                                                    Dakota/Beulah
                                                </option>
                                                <option value="America/North_Dakota/Center">(GMT/UTC - 06:00) North
                                                    Dakota/Center
                                                </option>
                                                <option value="America/North_Dakota/New_Salem">(GMT/UTC - 06:00) North
                                                    Dakota/New Salem
                                                </option>
                                                <option value="America/Ojinaga">(GMT/UTC - 07:00) Ojinaga</option>
                                                <option value="America/Panama">(GMT/UTC - 05:00) Panama</option>
                                                <option value="America/Pangnirtung">(GMT/UTC - 05:00) Pangnirtung
                                                </option>
                                                <option value="America/Paramaribo">(GMT/UTC - 03:00) Paramaribo</option>
                                                <option value="America/Phoenix">(GMT/UTC - 07:00) Phoenix</option>
                                                <option value="America/Port-au-Prince">(GMT/UTC - 05:00) Port-au-Prince
                                                </option>
                                                <option value="America/Port_of_Spain">(GMT/UTC - 04:00) Port of Spain
                                                </option>
                                                <option value="America/Porto_Velho">(GMT/UTC - 04:00) Porto Velho
                                                </option>
                                                <option value="America/Puerto_Rico">(GMT/UTC - 04:00) Puerto Rico
                                                </option>
                                                <option value="America/Rainy_River">(GMT/UTC - 06:00) Rainy River
                                                </option>
                                                <option value="America/Rankin_Inlet">(GMT/UTC - 06:00) Rankin Inlet
                                                </option>
                                                <option value="America/Recife">(GMT/UTC - 03:00) Recife</option>
                                                <option value="America/Regina">(GMT/UTC - 06:00) Regina</option>
                                                <option value="America/Resolute">(GMT/UTC - 06:00) Resolute</option>
                                                <option value="America/Rio_Branco">(GMT/UTC - 05:00) Rio Branco</option>
                                                <option value="America/Santarem">(GMT/UTC - 03:00) Santarem</option>
                                                <option value="America/Santiago">(GMT/UTC - 03:00) Santiago</option>
                                                <option value="America/Santo_Domingo">(GMT/UTC - 04:00) Santo Domingo
                                                </option>
                                                <option value="America/Sao_Paulo">(GMT/UTC - 02:00) Sao Paulo</option>
                                                <option value="America/Scoresbysund">(GMT/UTC - 01:00) Scoresbysund
                                                </option>
                                                <option value="America/Sitka">(GMT/UTC - 09:00) Sitka</option>
                                                <option value="America/St_Barthelemy">(GMT/UTC - 04:00) St. Barthelemy
                                                </option>
                                                <option value="America/St_Johns">(GMT/UTC - 03:30) St. Johns</option>
                                                <option value="America/St_Kitts">(GMT/UTC - 04:00) St. Kitts</option>
                                                <option value="America/St_Lucia">(GMT/UTC - 04:00) St. Lucia</option>
                                                <option value="America/St_Thomas">(GMT/UTC - 04:00) St. Thomas</option>
                                                <option value="America/St_Vincent">(GMT/UTC - 04:00) St. Vincent
                                                </option>
                                                <option value="America/Swift_Current">(GMT/UTC - 06:00) Swift Current
                                                </option>
                                                <option value="America/Tegucigalpa">(GMT/UTC - 06:00) Tegucigalpa
                                                </option>
                                                <option value="America/Thule">(GMT/UTC - 04:00) Thule</option>
                                                <option value="America/Thunder_Bay">(GMT/UTC - 05:00) Thunder Bay
                                                </option>
                                                <option value="America/Tijuana">(GMT/UTC - 08:00) Tijuana</option>
                                                <option value="America/Toronto">(GMT/UTC - 05:00) Toronto</option>
                                                <option value="America/Tortola">(GMT/UTC - 04:00) Tortola</option>
                                                <option value="America/Vancouver">(GMT/UTC - 08:00) Vancouver</option>
                                                <option value="America/Whitehorse">(GMT/UTC - 08:00) Whitehorse</option>
                                                <option value="America/Winnipeg">(GMT/UTC - 06:00) Winnipeg</option>
                                                <option value="America/Yakutat">(GMT/UTC - 09:00) Yakutat</option>
                                                <option value="America/Yellowknife">(GMT/UTC - 07:00) Yellowknife
                                                </option>
                                            </optgroup>
                                            <optgroup label="Antarctica">
                                                <option value="Antarctica/Casey">(GMT/UTC + 08:00) Casey</option>
                                                <option value="Antarctica/Davis">(GMT/UTC + 07:00) Davis</option>
                                                <option value="Antarctica/DumontDUrville">(GMT/UTC + 10:00)
                                                    DumontDUrville
                                                </option>
                                                <option value="Antarctica/Macquarie">(GMT/UTC + 11:00) Macquarie
                                                </option>
                                                <option value="Antarctica/Mawson">(GMT/UTC + 05:00) Mawson</option>
                                                <option value="Antarctica/McMurdo">(GMT/UTC + 13:00) McMurdo</option>
                                                <option value="Antarctica/Palmer">(GMT/UTC - 03:00) Palmer</option>
                                                <option value="Antarctica/Rothera">(GMT/UTC - 03:00) Rothera</option>
                                                <option value="Antarctica/Syowa">(GMT/UTC + 03:00) Syowa</option>
                                                <option value="Antarctica/Troll">(GMT/UTC + 00:00) Troll</option>
                                                <option value="Antarctica/Vostok">(GMT/UTC + 06:00) Vostok</option>
                                            </optgroup>
                                            <optgroup label="Arctic">
                                                <option value="Arctic/Longyearbyen">(GMT/UTC + 01:00) Longyearbyen
                                                </option>
                                            </optgroup>
                                            <optgroup label="Asia">
                                                <option value="Asia/Aden">(GMT/UTC + 03:00) Aden</option>
                                                <option value="Asia/Almaty">(GMT/UTC + 06:00) Almaty</option>
                                                <option value="Asia/Amman">(GMT/UTC + 02:00) Amman</option>
                                                <option value="Asia/Anadyr">(GMT/UTC + 12:00) Anadyr</option>
                                                <option value="Asia/Aqtau">(GMT/UTC + 05:00) Aqtau</option>
                                                <option value="Asia/Aqtobe">(GMT/UTC + 05:00) Aqtobe</option>
                                                <option value="Asia/Ashgabat">(GMT/UTC + 05:00) Ashgabat</option>
                                                <option value="Asia/Baghdad">(GMT/UTC + 03:00) Baghdad</option>
                                                <option value="Asia/Bahrain">(GMT/UTC + 03:00) Bahrain</option>
                                                <option value="Asia/Baku">(GMT/UTC + 04:00) Baku</option>
                                                <option value="Asia/Bangkok">(GMT/UTC + 07:00) Bangkok</option>
                                                <option value="Asia/Barnaul">(GMT/UTC + 07:00) Barnaul</option>
                                                <option value="Asia/Beirut">(GMT/UTC + 02:00) Beirut</option>
                                                <option value="Asia/Bishkek">(GMT/UTC + 06:00) Bishkek</option>
                                                <option value="Asia/Brunei">(GMT/UTC + 08:00) Brunei</option>
                                                <option value="Asia/Chita">(GMT/UTC + 09:00) Chita</option>
                                                <option value="Asia/Choibalsan">(GMT/UTC + 08:00) Choibalsan</option>
                                                <option value="Asia/Colombo">(GMT/UTC + 05:30) Colombo</option>
                                                <option value="Asia/Damascus">(GMT/UTC + 02:00) Damascus</option>
                                                <option value="Asia/Dhaka">(GMT/UTC + 06:00) Dhaka</option>
                                                <option value="Asia/Dili">(GMT/UTC + 09:00) Dili</option>
                                                <option value="Asia/Dubai">(GMT/UTC + 04:00) Dubai</option>
                                                <option value="Asia/Dushanbe">(GMT/UTC + 05:00) Dushanbe</option>
                                                <option value="Asia/Gaza">(GMT/UTC + 02:00) Gaza</option>
                                                <option value="Asia/Hebron">(GMT/UTC + 02:00) Hebron</option>
                                                <option value="Asia/Ho_Chi_Minh">(GMT/UTC + 07:00) Ho Chi Minh</option>
                                                <option value="Asia/Hong_Kong">(GMT/UTC + 08:00) Hong Kong</option>
                                                <option value="Asia/Hovd">(GMT/UTC + 07:00) Hovd</option>
                                                <option value="Asia/Irkutsk">(GMT/UTC + 08:00) Irkutsk</option>
                                                <option value="Asia/Jakarta">(GMT/UTC + 07:00) Jakarta</option>
                                                <option value="Asia/Jayapura">(GMT/UTC + 09:00) Jayapura</option>
                                                <option value="Asia/Jerusalem">(GMT/UTC + 02:00) Jerusalem</option>
                                                <option value="Asia/Kabul">(GMT/UTC + 04:30) Kabul</option>
                                                <option value="Asia/Kamchatka">(GMT/UTC + 12:00) Kamchatka</option>
                                                <option value="Asia/Karachi">(GMT/UTC + 05:00) Karachi</option>
                                                <option value="Asia/Kathmandu">(GMT/UTC + 05:45) Kathmandu</option>
                                                <option value="Asia/Khandyga">(GMT/UTC + 09:00) Khandyga</option>
                                                <option value="Asia/Kolkata">(GMT/UTC + 05:30) Kolkata</option>
                                                <option value="Asia/Krasnoyarsk">(GMT/UTC + 07:00) Krasnoyarsk</option>
                                                <option value="Asia/Kuala_Lumpur">(GMT/UTC + 08:00) Kuala Lumpur
                                                </option>
                                                <option value="Asia/Kuching">(GMT/UTC + 08:00) Kuching</option>
                                                <option value="Asia/Kuwait">(GMT/UTC + 03:00) Kuwait</option>
                                                <option value="Asia/Macau">(GMT/UTC + 08:00) Macau</option>
                                                <option value="Asia/Magadan">(GMT/UTC + 10:00) Magadan</option>
                                                <option value="Asia/Makassar">(GMT/UTC + 08:00) Makassar</option>
                                                <option value="Asia/Manila">(GMT/UTC + 08:00) Manila</option>
                                                <option value="Asia/Muscat">(GMT/UTC + 04:00) Muscat</option>
                                                <option value="Asia/Nicosia">(GMT/UTC + 02:00) Nicosia</option>
                                                <option value="Asia/Novokuznetsk">(GMT/UTC + 07:00) Novokuznetsk
                                                </option>
                                                <option value="Asia/Novosibirsk">(GMT/UTC + 06:00) Novosibirsk</option>
                                                <option value="Asia/Omsk">(GMT/UTC + 06:00) Omsk</option>
                                                <option value="Asia/Oral">(GMT/UTC + 05:00) Oral</option>
                                                <option value="Asia/Phnom_Penh">(GMT/UTC + 07:00) Phnom Penh</option>
                                                <option value="Asia/Pontianak">(GMT/UTC + 07:00) Pontianak</option>
                                                <option value="Asia/Pyongyang">(GMT/UTC + 08:30) Pyongyang</option>
                                                <option value="Asia/Qatar">(GMT/UTC + 03:00) Qatar</option>
                                                <option value="Asia/Qyzylorda">(GMT/UTC + 06:00) Qyzylorda</option>
                                                <option value="Asia/Rangoon">(GMT/UTC + 06:30) Rangoon</option>
                                                <option value="Asia/Riyadh">(GMT/UTC + 03:00) Riyadh</option>
                                                <option value="Asia/Sakhalin">(GMT/UTC + 11:00) Sakhalin</option>
                                                <option value="Asia/Samarkand">(GMT/UTC + 05:00) Samarkand</option>
                                                <option value="Asia/Seoul">(GMT/UTC + 09:00) Seoul</option>
                                                <option value="Asia/Shanghai">(GMT/UTC + 08:00) Shanghai</option>
                                                <option value="Asia/Singapore">(GMT/UTC + 08:00) Singapore</option>
                                                <option value="Asia/Srednekolymsk">(GMT/UTC + 11:00) Srednekolymsk
                                                </option>
                                                <option value="Asia/Taipei">(GMT/UTC + 08:00) Taipei</option>
                                                <option value="Asia/Tashkent">(GMT/UTC + 05:00) Tashkent</option>
                                                <option value="Asia/Tbilisi">(GMT/UTC + 04:00) Tbilisi</option>
                                                <option value="Asia/Tehran">(GMT/UTC + 03:30) Tehran</option>
                                                <option value="Asia/Thimphu">(GMT/UTC + 06:00) Thimphu</option>
                                                <option value="Asia/Tokyo">(GMT/UTC + 09:00) Tokyo</option>
                                                <option value="Asia/Ulaanbaatar">(GMT/UTC + 08:00) Ulaanbaatar</option>
                                                <option value="Asia/Urumqi">(GMT/UTC + 06:00) Urumqi</option>
                                                <option value="Asia/Ust-Nera">(GMT/UTC + 10:00) Ust-Nera</option>
                                                <option value="Asia/Vientiane">(GMT/UTC + 07:00) Vientiane</option>
                                                <option value="Asia/Vladivostok">(GMT/UTC + 10:00) Vladivostok</option>
                                                <option value="Asia/Yakutsk">(GMT/UTC + 09:00) Yakutsk</option>
                                                <option value="Asia/Yekaterinburg">(GMT/UTC + 05:00) Yekaterinburg
                                                </option>
                                                <option value="Asia/Yerevan">(GMT/UTC + 04:00) Yerevan</option>
                                            </optgroup>
                                            <optgroup label="Atlantic">
                                                <option value="Atlantic/Azores">(GMT/UTC - 01:00) Azores</option>
                                                <option value="Atlantic/Bermuda">(GMT/UTC - 04:00) Bermuda</option>
                                                <option value="Atlantic/Canary">(GMT/UTC + 00:00) Canary</option>
                                                <option value="Atlantic/Cape_Verde">(GMT/UTC - 01:00) Cape Verde
                                                </option>
                                                <option value="Atlantic/Faroe">(GMT/UTC + 00:00) Faroe</option>
                                                <option value="Atlantic/Madeira">(GMT/UTC + 00:00) Madeira</option>
                                                <option value="Atlantic/Reykjavik">(GMT/UTC + 00:00) Reykjavik</option>
                                                <option value="Atlantic/South_Georgia">(GMT/UTC - 02:00) South Georgia
                                                </option>
                                                <option value="Atlantic/St_Helena">(GMT/UTC + 00:00) St. Helena</option>
                                                <option value="Atlantic/Stanley">(GMT/UTC - 03:00) Stanley</option>
                                            </optgroup>
                                            <optgroup label="Australia">
                                                <option value="Australia/Adelaide">(GMT/UTC + 10:30) Adelaide</option>
                                                <option value="Australia/Brisbane">(GMT/UTC + 10:00) Brisbane</option>
                                                <option value="Australia/Broken_Hill">(GMT/UTC + 10:30) Broken Hill
                                                </option>
                                                <option value="Australia/Currie">(GMT/UTC + 11:00) Currie</option>
                                                <option value="Australia/Darwin">(GMT/UTC + 09:30) Darwin</option>
                                                <option value="Australia/Eucla">(GMT/UTC + 08:45) Eucla</option>
                                                <option value="Australia/Hobart">(GMT/UTC + 11:00) Hobart</option>
                                                <option value="Australia/Lindeman">(GMT/UTC + 10:00) Lindeman</option>
                                                <option value="Australia/Lord_Howe">(GMT/UTC + 11:00) Lord Howe</option>
                                                <option value="Australia/Melbourne">(GMT/UTC + 11:00) Melbourne</option>
                                                <option value="Australia/Perth">(GMT/UTC + 08:00) Perth</option>
                                                <option value="Australia/Sydney">(GMT/UTC + 11:00) Sydney</option>
                                            </optgroup>
                                            <optgroup label="Europe">
                                                <option value="Europe/Amsterdam">(GMT/UTC + 01:00) Amsterdam</option>
                                                <option value="Europe/Andorra">(GMT/UTC + 01:00) Andorra</option>
                                                <option value="Europe/Astrakhan">(GMT/UTC + 04:00) Astrakhan</option>
                                                <option value="Europe/Athens">(GMT/UTC + 02:00) Athens</option>
                                                <option value="Europe/Belgrade">(GMT/UTC + 01:00) Belgrade</option>
                                                <option value="Europe/Berlin">(GMT/UTC + 01:00) Berlin</option>
                                                <option value="Europe/Bratislava">(GMT/UTC + 01:00) Bratislava</option>
                                                <option value="Europe/Brussels">(GMT/UTC + 01:00) Brussels</option>
                                                <option value="Europe/Bucharest">(GMT/UTC + 02:00) Bucharest</option>
                                                <option value="Europe/Budapest">(GMT/UTC + 01:00) Budapest</option>
                                                <option value="Europe/Busingen">(GMT/UTC + 01:00) Busingen</option>
                                                <option value="Europe/Chisinau">(GMT/UTC + 02:00) Chisinau</option>
                                                <option value="Europe/Copenhagen">(GMT/UTC + 01:00) Copenhagen</option>
                                                <option value="Europe/Dublin">(GMT/UTC + 00:00) Dublin</option>
                                                <option value="Europe/Gibraltar">(GMT/UTC + 01:00) Gibraltar</option>
                                                <option value="Europe/Guernsey">(GMT/UTC + 00:00) Guernsey</option>
                                                <option value="Europe/Helsinki">(GMT/UTC + 02:00) Helsinki</option>
                                                <option value="Europe/Isle_of_Man">(GMT/UTC + 00:00) Isle of Man
                                                </option>
                                                <option value="Europe/Istanbul">(GMT/UTC + 02:00) Istanbul</option>
                                                <option value="Europe/Jersey">(GMT/UTC + 00:00) Jersey</option>
                                                <option value="Europe/Kaliningrad">(GMT/UTC + 02:00) Kaliningrad
                                                </option>
                                                <option value="Europe/Kiev">(GMT/UTC + 02:00) Kiev</option>
                                                <option value="Europe/Lisbon">(GMT/UTC + 00:00) Lisbon</option>
                                                <option value="Europe/Ljubljana">(GMT/UTC + 01:00) Ljubljana</option>
                                                <option value="Europe/London">(GMT/UTC + 00:00) London</option>
                                                <option value="Europe/Luxembourg">(GMT/UTC + 01:00) Luxembourg</option>
                                                <option value="Europe/Madrid">(GMT/UTC + 01:00) Madrid</option>
                                                <option value="Europe/Malta">(GMT/UTC + 01:00) Malta</option>
                                                <option value="Europe/Mariehamn">(GMT/UTC + 02:00) Mariehamn</option>
                                                <option value="Europe/Minsk">(GMT/UTC + 03:00) Minsk</option>
                                                <option value="Europe/Monaco">(GMT/UTC + 01:00) Monaco</option>
                                                <option value="Europe/Moscow">(GMT/UTC + 03:00) Moscow</option>
                                                <option value="Europe/Oslo">(GMT/UTC + 01:00) Oslo</option>
                                                <option value="Europe/Paris">(GMT/UTC + 01:00) Paris</option>
                                                <option value="Europe/Podgorica">(GMT/UTC + 01:00) Podgorica</option>
                                                <option value="Europe/Prague">(GMT/UTC + 01:00) Prague</option>
                                                <option value="Europe/Riga">(GMT/UTC + 02:00) Riga</option>
                                                <option value="Europe/Rome">(GMT/UTC + 01:00) Rome</option>
                                                <option value="Europe/Samara">(GMT/UTC + 04:00) Samara</option>
                                                <option value="Europe/San_Marino">(GMT/UTC + 01:00) San Marino</option>
                                                <option value="Europe/Sarajevo">(GMT/UTC + 01:00) Sarajevo</option>
                                                <option value="Europe/Simferopol">(GMT/UTC + 03:00) Simferopol</option>
                                                <option value="Europe/Skopje">(GMT/UTC + 01:00) Skopje</option>
                                                <option value="Europe/Sofia">(GMT/UTC + 02:00) Sofia</option>
                                                <option value="Europe/Stockholm">(GMT/UTC + 01:00) Stockholm</option>
                                                <option value="Europe/Tallinn">(GMT/UTC + 02:00) Tallinn</option>
                                                <option value="Europe/Tirane">(GMT/UTC + 01:00) Tirane</option>
                                                <option value="Europe/Ulyanovsk">(GMT/UTC + 04:00) Ulyanovsk</option>
                                                <option value="Europe/Uzhgorod">(GMT/UTC + 02:00) Uzhgorod</option>
                                                <option value="Europe/Vaduz">(GMT/UTC + 01:00) Vaduz</option>
                                                <option value="Europe/Vatican">(GMT/UTC + 01:00) Vatican</option>
                                                <option value="Europe/Vienna">(GMT/UTC + 01:00) Vienna</option>
                                                <option value="Europe/Vilnius">(GMT/UTC + 02:00) Vilnius</option>
                                                <option value="Europe/Volgograd">(GMT/UTC + 03:00) Volgograd</option>
                                                <option value="Europe/Warsaw">(GMT/UTC + 01:00) Warsaw</option>
                                                <option value="Europe/Zagreb">(GMT/UTC + 01:00) Zagreb</option>
                                                <option value="Europe/Zaporozhye">(GMT/UTC + 02:00) Zaporozhye</option>
                                                <option value="Europe/Zurich">(GMT/UTC + 01:00) Zurich</option>
                                            </optgroup>
                                            <optgroup label="Indian">
                                                <option value="Indian/Antananarivo">(GMT/UTC + 03:00) Antananarivo
                                                </option>
                                                <option value="Indian/Chagos">(GMT/UTC + 06:00) Chagos</option>
                                                <option value="Indian/Christmas">(GMT/UTC + 07:00) Christmas</option>
                                                <option value="Indian/Cocos">(GMT/UTC + 06:30) Cocos</option>
                                                <option value="Indian/Comoro">(GMT/UTC + 03:00) Comoro</option>
                                                <option value="Indian/Kerguelen">(GMT/UTC + 05:00) Kerguelen</option>
                                                <option value="Indian/Mahe">(GMT/UTC + 04:00) Mahe</option>
                                                <option value="Indian/Maldives">(GMT/UTC + 05:00) Maldives</option>
                                                <option value="Indian/Mauritius">(GMT/UTC + 04:00) Mauritius</option>
                                                <option value="Indian/Mayotte">(GMT/UTC + 03:00) Mayotte</option>
                                                <option value="Indian/Reunion">(GMT/UTC + 04:00) Reunion</option>
                                            </optgroup>
                                            <optgroup label="Pacific">
                                                <option value="Pacific/Apia">(GMT/UTC + 14:00) Apia</option>
                                                <option value="Pacific/Auckland">(GMT/UTC + 13:00) Auckland</option>
                                                <option value="Pacific/Bougainville">(GMT/UTC + 11:00) Bougainville
                                                </option>
                                                <option value="Pacific/Chatham">(GMT/UTC + 13:45) Chatham</option>
                                                <option value="Pacific/Chuuk">(GMT/UTC + 10:00) Chuuk</option>
                                                <option value="Pacific/Easter">(GMT/UTC - 05:00) Easter</option>
                                                <option value="Pacific/Efate">(GMT/UTC + 11:00) Efate</option>
                                                <option value="Pacific/Enderbury">(GMT/UTC + 13:00) Enderbury</option>
                                                <option value="Pacific/Fakaofo">(GMT/UTC + 13:00) Fakaofo</option>
                                                <option value="Pacific/Fiji">(GMT/UTC + 12:00) Fiji</option>
                                                <option value="Pacific/Funafuti">(GMT/UTC + 12:00) Funafuti</option>
                                                <option value="Pacific/Galapagos">(GMT/UTC - 06:00) Galapagos</option>
                                                <option value="Pacific/Gambier">(GMT/UTC - 09:00) Gambier</option>
                                                <option value="Pacific/Guadalcanal">(GMT/UTC + 11:00) Guadalcanal
                                                </option>
                                                <option value="Pacific/Guam">(GMT/UTC + 10:00) Guam</option>
                                                <option value="Pacific/Honolulu">(GMT/UTC - 10:00) Honolulu</option>
                                                <option value="Pacific/Johnston">(GMT/UTC - 10:00) Johnston</option>
                                                <option value="Pacific/Kiritimati">(GMT/UTC + 14:00) Kiritimati</option>
                                                <option value="Pacific/Kosrae">(GMT/UTC + 11:00) Kosrae</option>
                                                <option value="Pacific/Kwajalein">(GMT/UTC + 12:00) Kwajalein</option>
                                                <option value="Pacific/Majuro">(GMT/UTC + 12:00) Majuro</option>
                                                <option value="Pacific/Marquesas">(GMT/UTC - 09:30) Marquesas</option>
                                                <option value="Pacific/Midway">(GMT/UTC - 11:00) Midway</option>
                                                <option value="Pacific/Nauru">(GMT/UTC + 12:00) Nauru</option>
                                                <option value="Pacific/Niue">(GMT/UTC - 11:00) Niue</option>
                                                <option value="Pacific/Norfolk">(GMT/UTC + 11:00) Norfolk</option>
                                                <option value="Pacific/Noumea">(GMT/UTC + 11:00) Noumea</option>
                                                <option value="Pacific/Pago_Pago">(GMT/UTC - 11:00) Pago Pago</option>
                                                <option value="Pacific/Palau">(GMT/UTC + 09:00) Palau</option>
                                                <option value="Pacific/Pitcairn">(GMT/UTC - 08:00) Pitcairn</option>
                                                <option value="Pacific/Pohnpei">(GMT/UTC + 11:00) Pohnpei</option>
                                                <option value="Pacific/Port_Moresby">(GMT/UTC + 10:00) Port Moresby
                                                </option>
                                                <option value="Pacific/Rarotonga">(GMT/UTC - 10:00) Rarotonga</option>
                                                <option value="Pacific/Saipan">(GMT/UTC + 10:00) Saipan</option>
                                                <option value="Pacific/Tahiti">(GMT/UTC - 10:00) Tahiti</option>
                                                <option value="Pacific/Tarawa">(GMT/UTC + 12:00) Tarawa</option>
                                                <option value="Pacific/Tongatapu">(GMT/UTC + 13:00) Tongatapu</option>
                                                <option value="Pacific/Wake">(GMT/UTC + 12:00) Wake</option>
                                                <option value="Pacific/Wallis">(GMT/UTC + 12:00) Wallis</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Store Currency:</strong></label>
                                    <div class="col-lg-9">
                                        <select name="currencyId" class="form-control form-control-lg select">
                                        <option value="AED" @if(config('appSettings.currencyId')=="AED" ) selected
                                        @endif>AED</option>
                                        <option value="AFN" @if(config('appSettings.currencyId')=="AFN" ) selected
                                        @endif>AFN</option>
                                        <option value="ALL" @if(config('appSettings.currencyId')=="ALL" ) selected
                                        @endif>ALL</option>
                                        <option value="AMD" @if(config('appSettings.currencyId')=="AMD" ) selected
                                        @endif>AMD</option>
                                        <option value="ANG" @if(config('appSettings.currencyId')=="ANG" ) selected
                                        @endif>ANG</option>
                                        <option value="ANG" @if(config('appSettings.currencyId')=="ANG" ) selected
                                        @endif>ANG</option>
                                        <option value="AOA" @if(config('appSettings.currencyId')=="AOA" ) selected
                                        @endif>AOA</option>
                                        <option value="ARS" @if(config('appSettings.currencyId')=="ARS" ) selected
                                        @endif>ARS</option>
                                        <option value="AUD" @if(config('appSettings.currencyId')=="AUD" ) selected
                                        @endif>AUD</option>
                                        <option value="AWG" @if(config('appSettings.currencyId')=="AWG" ) selected
                                        @endif>AWG</option>
                                        <option value="AZN" @if(config('appSettings.currencyId')=="AZN" ) selected
                                        @endif>AZN</option>
                                        <option value="BAM" @if(config('appSettings.currencyId')=="BAM" ) selected
                                        @endif>BAM</option>
                                        <option value="BBD" @if(config('appSettings.currencyId')=="BBD" ) selected
                                        @endif>BBD</option>
                                        <option value="BDT" @if(config('appSettings.currencyId')=="BDT" ) selected
                                        @endif>BDT</option>
                                        <option value="BGN" @if(config('appSettings.currencyId')=="BGN" ) selected
                                        @endif>BGN</option>
                                        <option value="BHD" @if(config('appSettings.currencyId')=="BHD" ) selected
                                        @endif>BHD</option>
                                        <option value="BIF" @if(config('appSettings.currencyId')=="BIF" ) selected
                                        @endif>BIF</option>
                                        <option value="BMD" @if(config('appSettings.currencyId')=="BMD" ) selected
                                        @endif>BMD</option>
                                        <option value="BND" @if(config('appSettings.currencyId')=="BND" ) selected
                                        @endif>BND</option>
                                        <option value="BOB" @if(config('appSettings.currencyId')=="BOB" ) selected
                                        @endif>BOB</option>
                                        <option value="BOV" @if(config('appSettings.currencyId')=="BOV" ) selected
                                        @endif>BOV</option>
                                        <option value="BRL" @if(config('appSettings.currencyId')=="BRL" ) selected
                                        @endif>BRL</option>
                                        <option value="BSD" @if(config('appSettings.currencyId')=="BSD" ) selected
                                        @endif>BSD</option>
                                        <option value="BTN" @if(config('appSettings.currencyId')=="BTN" ) selected
                                        @endif>BTN</option>
                                        <option value="BWP" @if(config('appSettings.currencyId')=="BWP" ) selected
                                        @endif>BWP</option>
                                        <option value="BYN" @if(config('appSettings.currencyId')=="BYN" ) selected
                                        @endif>BYN</option>
                                        <option value="BZD" @if(config('appSettings.currencyId')=="BZD" ) selected
                                        @endif>BZD</option>
                                        <option value="CAD" @if(config('appSettings.currencyId')=="CAD" ) selected
                                        @endif>CAD</option>
                                        <option value="CDF" @if(config('appSettings.currencyId')=="CDF" ) selected
                                        @endif>CDF</option>
                                        <option value="CHE" @if(config('appSettings.currencyId')=="CHE" ) selected
                                        @endif>CHE</option>
                                        <option value="CHF" @if(config('appSettings.currencyId')=="CHF" ) selected
                                        @endif>CHF</option>
                                        <option value="CHW" @if(config('appSettings.currencyId')=="CHW" ) selected
                                        @endif>CHW</option>
                                        <option value="CLF" @if(config('appSettings.currencyId')=="CLF" ) selected
                                        @endif>CLF</option>
                                        <option value="CLP" @if(config('appSettings.currencyId')=="CLP" ) selected
                                        @endif>CLP</option>
                                        <option value="CNY" @if(config('appSettings.currencyId')=="CNY" ) selected
                                        @endif>CNY</option>
                                        <option value="COP" @if(config('appSettings.currencyId')=="COP" ) selected
                                        @endif>COP</option>
                                        <option value="COU" @if(config('appSettings.currencyId')=="COU" ) selected
                                        @endif>COU</option>
                                        <option value="CRC" @if(config('appSettings.currencyId')=="CRC" ) selected
                                        @endif>CRC</option>
                                        <option value="CUC" @if(config('appSettings.currencyId')=="CUC" ) selected
                                        @endif>CUC</option>
                                        <option value="CVE" @if(config('appSettings.currencyId')=="CVE" ) selected
                                        @endif>CVE</option>
                                        <option value="CZK" @if(config('appSettings.currencyId')=="CZK" ) selected
                                        @endif>CZK</option>
                                        <option value="DJF" @if(config('appSettings.currencyId')=="DJF" ) selected
                                        @endif>DJF</option>
                                        <option value="DKK" @if(config('appSettings.currencyId')=="DKK" ) selected
                                        @endif>DKK</option>
                                        <option value="DOP" @if(config('appSettings.currencyId')=="DOP" ) selected
                                        @endif>DOP</option>
                                        <option value="DZD" @if(config('appSettings.currencyId')=="DZD" ) selected
                                        @endif>DZD</option>
                                        <option value="EGP" @if(config('appSettings.currencyId')=="EGP" ) selected
                                        @endif>EGP</option>
                                        <option value="ERN" @if(config('appSettings.currencyId')=="ERN" ) selected
                                        @endif>ERN</option>
                                        <option value="ETB" @if(config('appSettings.currencyId')=="ETB" ) selected
                                        @endif>ETB</option>
                                        <option value="EUR" @if(config('appSettings.currencyId')=="EUR" ) selected
                                        @endif>EUR</option>
                                        <option value="FJD" @if(config('appSettings.currencyId')=="FJD" ) selected
                                        @endif>FJD</option>
                                        <option value="FKP" @if(config('appSettings.currencyId')=="FKP" ) selected
                                        @endif>FKP</option>
                                        <option value="GBP" @if(config('appSettings.currencyId')=="GBP" ) selected
                                        @endif>GBP</option>
                                        <option value="GEL" @if(config('appSettings.currencyId')=="GEL" ) selected
                                        @endif>GEL</option>
                                        <option value="GHS" @if(config('appSettings.currencyId')=="GHS" ) selected
                                        @endif>GHS</option>
                                        <option value="GIP" @if(config('appSettings.currencyId')=="GIP" ) selected
                                        @endif>GIP</option>
                                        <option value="GMD" @if(config('appSettings.currencyId')=="GMD" ) selected
                                        @endif>GMD</option>
                                        <option value="GNF" @if(config('appSettings.currencyId')=="GNF" ) selected
                                        @endif>GNF</option>
                                        <option value="GTQ" @if(config('appSettings.currencyId')=="GTQ" ) selected
                                        @endif>GTQ</option>
                                        <option value="GYD" @if(config('appSettings.currencyId')=="GYD" ) selected
                                        @endif>GYD</option>
                                        <option value="HKD" @if(config('appSettings.currencyId')=="HKD" ) selected
                                        @endif>HKD</option>
                                        <option value="HNL" @if(config('appSettings.currencyId')=="HNL" ) selected
                                        @endif>HNL</option>
                                        <option value="HRK" @if(config('appSettings.currencyId')=="HRK" ) selected
                                        @endif>HRK</option>
                                        <option value="HTG" @if(config('appSettings.currencyId')=="HTG" ) selected
                                        @endif>HTG</option>
                                        <option value="HUF" @if(config('appSettings.currencyId')=="HUF" ) selected
                                        @endif>HUF</option>
                                        <option value="IDR" @if(config('appSettings.currencyId')=="IDR" ) selected
                                        @endif>IDR</option>
                                        <option value="ILS" @if(config('appSettings.currencyId')=="ILS" ) selected
                                        @endif>ILS</option>
                                        <option value="INR" @if(config('appSettings.currencyId')=="INR" ) selected
                                        @endif>INR</option>
                                        <option value="IQD" @if(config('appSettings.currencyId')=="IQD" ) selected
                                        @endif>IQD</option>
                                        <option value="IRR" @if(config('appSettings.currencyId')=="IRR" ) selected
                                        @endif>IRR</option>
                                        <option value="ISK" @if(config('appSettings.currencyId')=="ISK" ) selected
                                        @endif>ISK</option>
                                        <option value="JMD" @if(config('appSettings.currencyId')=="JMD" ) selected
                                        @endif>JMD</option>
                                        <option value="JOD" @if(config('appSettings.currencyId')=="JOD" ) selected
                                        @endif>JOD</option>
                                        <option value="JPY" @if(config('appSettings.currencyId')=="JPY" ) selected
                                        @endif>JPY</option>
                                        <option value="KES" @if(config('appSettings.currencyId')=="KES" ) selected
                                        @endif>KES</option>
                                        <option value="KGS" @if(config('appSettings.currencyId')=="KGS" ) selected
                                        @endif>KGS</option>
                                        <option value="KHR" @if(config('appSettings.currencyId')=="KHR" ) selected
                                        @endif>KHR</option>
                                        <option value="KMF" @if(config('appSettings.currencyId')=="KMF" ) selected
                                        @endif>KMF</option>
                                        <option value="KPW" @if(config('appSettings.currencyId')=="KPW" ) selected
                                        @endif>KPW</option>
                                        <option value="KRW" @if(config('appSettings.currencyId')=="KRW" ) selected
                                        @endif>KRW</option>
                                        <option value="KWD" @if(config('appSettings.currencyId')=="KWD" ) selected
                                        @endif>KWD</option>
                                        <option value="KYD" @if(config('appSettings.currencyId')=="KYD" ) selected
                                        @endif>KYD</option>
                                        <option value="KZT" @if(config('appSettings.currencyId')=="KZT" ) selected
                                        @endif>KZT</option>
                                        <option value="LAK" @if(config('appSettings.currencyId')=="LAK" ) selected
                                        @endif>LAK</option>
                                        <option value="LBP" @if(config('appSettings.currencyId')=="LBP" ) selected
                                        @endif>LBP</option>
                                        <option value="LKR" @if(config('appSettings.currencyId')=="LKR" ) selected
                                        @endif>LKR</option>
                                        <option value="LRD" @if(config('appSettings.currencyId')=="LRD" ) selected
                                        @endif>LRD</option>
                                        <option value="LSL" @if(config('appSettings.currencyId')=="LSL" ) selected
                                        @endif>LSL</option>
                                        <option value="LYD" @if(config('appSettings.currencyId')=="LYD" ) selected
                                        @endif>LYD</option>
                                        <option value="MAD" @if(config('appSettings.currencyId')=="MAD" ) selected
                                        @endif>MAD</option>
                                        <option value="MDL" @if(config('appSettings.currencyId')=="MDL" ) selected
                                        @endif>MDL</option>
                                        <option value="MGA" @if(config('appSettings.currencyId')=="MGA" ) selected
                                        @endif>MGA</option>
                                        <option value="MKD" @if(config('appSettings.currencyId')=="MKD" ) selected
                                        @endif>MKD</option>
                                        <option value="MMK" @if(config('appSettings.currencyId')=="MMK" ) selected
                                        @endif>MMK</option>
                                        <option value="MNT" @if(config('appSettings.currencyId')=="MNT" ) selected
                                        @endif>MNT</option>
                                        <option value="MOP" @if(config('appSettings.currencyId')=="MOP" ) selected
                                        @endif>MOP</option>
                                        <option value="MRU" @if(config('appSettings.currencyId')=="MRU" ) selected
                                        @endif>MRU</option>
                                        <option value="MUR" @if(config('appSettings.currencyId')=="MUR" ) selected
                                        @endif>MUR</option>
                                        <option value="MVR" @if(config('appSettings.currencyId')=="MVR" ) selected
                                        @endif>MVR</option>
                                        <option value="MWK" @if(config('appSettings.currencyId')=="MWK" ) selected
                                        @endif>MWK</option>
                                        <option value="MXN" @if(config('appSettings.currencyId')=="MXN" ) selected
                                        @endif>MXN</option>
                                        <option value="MXV" @if(config('appSettings.currencyId')=="MXV" ) selected
                                        @endif>MXV</option>
                                        <option value="MYR" @if(config('appSettings.currencyId')=="MYR" ) selected
                                        @endif>MYR</option>
                                        <option value="MZN" @if(config('appSettings.currencyId')=="MZN" ) selected
                                        @endif>MZN</option>
                                        <option value="NAD" @if(config('appSettings.currencyId')=="NAD" ) selected
                                        @endif>NAD</option>
                                        <option value="NGN" @if(config('appSettings.currencyId')=="NGN" ) selected
                                        @endif>NGN</option>
                                        <option value="NIO" @if(config('appSettings.currencyId')=="NIO" ) selected
                                        @endif>NIO</option>
                                        <option value="NOK" @if(config('appSettings.currencyId')=="NOK" ) selected
                                        @endif>NOK</option>
                                        <option value="NPR" @if(config('appSettings.currencyId')=="NPR" ) selected
                                        @endif>NPR</option> 
                                        <option value="NZD" @if(config('appSettings.currencyId')=="NZD" ) selected
                                        @endif>NZD</option>
                                        <option value="OMR" @if(config('appSettings.currencyId')=="OMR" ) selected
                                        @endif>OMR</option>
                                        <option value="PAB" @if(config('appSettings.currencyId')=="PAB" ) selected
                                        @endif>PAB</option>
                                        <option value="PEN" @if(config('appSettings.currencyId')=="PEN" ) selected
                                        @endif>PEN</option>
                                        <option value="PGK" @if(config('appSettings.currencyId')=="PGK" ) selected
                                        @endif>PGK</option>
                                        <option value="PHP" @if(config('appSettings.currencyId')=="PHP" ) selected
                                        @endif>PHP</option>
                                        <option value="PKR" @if(config('appSettings.currencyId')=="PKR" ) selected
                                        @endif>PKR</option>
                                        <option value="PLN" @if(config('appSettings.currencyId')=="PLN" ) selected
                                        @endif>PLN</option>
                                        <option value="PYG" @if(config('appSettings.currencyId')=="PYG" ) selected
                                        @endif>PYG</option>
                                        <option value="QAR" @if(config('appSettings.currencyId')=="QAR" ) selected
                                        @endif>QAR</option>
                                        <option value="RON" @if(config('appSettings.currencyId')=="RON" ) selected
                                        @endif>RON</option>
                                        <option value="RSD" @if(config('appSettings.currencyId')=="RSD" ) selected
                                        @endif>RSD</option>
                                        <option value="RUB" @if(config('appSettings.currencyId')=="RUB" ) selected
                                        @endif>RUB</option>
                                        <option value="RWF" @if(config('appSettings.currencyId')=="RWF" ) selected
                                        @endif>RWF</option>
                                        <option value="SAR" @if(config('appSettings.currencyId')=="SAR" ) selected
                                        @endif>SAR</option>
                                        <option value="SBD" @if(config('appSettings.currencyId')=="SBD" ) selected
                                        @endif>SBD</option>
                                        <option value="SCR" @if(config('appSettings.currencyId')=="SCR" ) selected
                                        @endif>SCR</option>
                                        <option value="SDG" @if(config('appSettings.currencyId')=="SDG" ) selected
                                        @endif>SDG</option>
                                        <option value="SEK" @if(config('appSettings.currencyId')=="SEK" ) selected
                                        @endif>SEK</option>
                                        <option value="SGD" @if(config('appSettings.currencyId')=="SGD" ) selected
                                        @endif>SGD</option>
                                        <option value="SHP" @if(config('appSettings.currencyId')=="SHP" ) selected
                                        @endif>SHP</option>
                                        <option value="SLL" @if(config('appSettings.currencyId')=="SLL" ) selected
                                        @endif>SLL</option>
                                        <option value="SOS" @if(config('appSettings.currencyId')=="SOS" ) selected
                                        @endif>SOS</option>
                                        <option value="SRD" @if(config('appSettings.currencyId')=="SRD" ) selected
                                        @endif>SRD</option>
                                        <option value="SSP" @if(config('appSettings.currencyId')=="SSP" ) selected
                                        @endif>SSP</option>
                                        <option value="STN" @if(config('appSettings.currencyId')=="STN" ) selected
                                        @endif>STN</option>
                                        <option value="SVC" @if(config('appSettings.currencyId')=="SVC" ) selected
                                        @endif>SVC</option>
                                        <option value="SYP" @if(config('appSettings.currencyId')=="SYP" ) selected
                                        @endif>SYP</option>
                                        <option value="SZL" @if(config('appSettings.currencyId')=="SZL" ) selected
                                        @endif>SZL</option>
                                        <option value="THB" @if(config('appSettings.currencyId')=="THB" ) selected
                                        @endif>THB</option>
                                        <option value="TJS" @if(config('appSettings.currencyId')=="TJS" ) selected
                                        @endif>TJS</option>
                                        <option value="TMT" @if(config('appSettings.currencyId')=="TMT" ) selected
                                        @endif>TMT</option>
                                        <option value="TND" @if(config('appSettings.currencyId')=="TND" ) selected
                                        @endif>TND</option>
                                        <option value="TOP" @if(config('appSettings.currencyId')=="TOP" ) selected
                                        @endif>TOP</option>
                                        <option value="TRY" @if(config('appSettings.currencyId')=="TRY" ) selected
                                        @endif>TRY</option>
                                        <option value="TTD" @if(config('appSettings.currencyId')=="TTD" ) selected
                                        @endif>TTD</option>
                                        <option value="TWD" @if(config('appSettings.currencyId')=="TWD" ) selected
                                        @endif>TWD</option>
                                        <option value="TZS" @if(config('appSettings.currencyId')=="TZS" ) selected
                                        @endif>TZS</option>
                                        <option value="UAH" @if(config('appSettings.currencyId')=="UAH" ) selected
                                        @endif>UAH</option>
                                        <option value="UGX" @if(config('appSettings.currencyId')=="UGX" ) selected
                                        @endif>UGX</option>
                                        <option value="USD" @if(config('appSettings.currencyId')=="USD" ) selected
                                        @endif>USD</option>
                                        <option value="USN" @if(config('appSettings.currencyId')=="USN" ) selected
                                        @endif>USN</option>
                                        <option value="UYI" @if(config('appSettings.currencyId')=="UYI" ) selected
                                        @endif>UYI</option>
                                        <option value="UYU" @if(config('appSettings.currencyId')=="UYU" ) selected
                                        @endif>UYU</option>
                                        <option value="UZS" @if(config('appSettings.currencyId')=="UZS" ) selected
                                        @endif>UZS</option>
                                        <option value="VEF" @if(config('appSettings.currencyId')=="VEF" ) selected
                                        @endif>VEF</option>
                                        <option value="VND" @if(config('appSettings.currencyId')=="VND" ) selected
                                        @endif>VND</option>
                                        <option value="VUV" @if(config('appSettings.currencyId')=="VUV" ) selected
                                        @endif>VUV</option>
                                        <option value="WST" @if(config('appSettings.currencyId')=="WST" ) selected
                                        @endif>WST</option>
                                        <option value="XAF" @if(config('appSettings.currencyId')=="XAF" ) selected
                                        @endif>XAF</option>
                                        <option value="XCD" @if(config('appSettings.currencyId')=="XCD" ) selected
                                        @endif>XCD</option>
                                        <option value="XDR" @if(config('appSettings.currencyId')=="XDR" ) selected
                                        @endif>XDR</option>
                                        <option value="XOF" @if(config('appSettings.currencyId')=="XOF" ) selected
                                        @endif>XOF</option>
                                        <option value="XPF" @if(config('appSettings.currencyId')=="XPF" ) selected
                                        @endif>XPF</option>
                                        <option value="XSU" @if(config('appSettings.currencyId')=="XSU" ) selected
                                        @endif>XSU</option>
                                        <option value="XUA" @if(config('appSettings.currencyId')=="XUA" ) selected
                                        @endif>XUA</option>
                                        <option value="YER" @if(config('appSettings.currencyId')=="YER" ) selected
                                        @endif>YER</option>
                                        <option value="ZAR" @if(config('appSettings.currencyId')=="ZAR" ) selected
                                        @endif>ZAR</option>
                                        <option value="ZMW" @if(config('appSettings.currencyId')=="ZMW" ) selected
                                        @endif>ZMW</option>
                                        <option value="ZWL" @if(config('appSettings.currencyId')=="ZWL" ) selected
                                        @endif>ZWL</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Currency Symbol:</strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="currencyFormat"
                                            value="{{ config('appSettings.currencyFormat') }}"
                                            placeholder="Currency Symbol like  $ or €">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Currency Symbol Alignment</strong></label>
                                    <div class="col-lg-9">
                                        <select name="currencySymbolAlign" class="form-control form-control-lg select">
                                        <option value="left" @if(config('appSettings.currencySymbolAlign')=="left" ) selected
                                        @endif>Left
                                        </option>
                                        <option value="right" @if(config('appSettings.currencySymbolAlign')=="right" ) selected
                                        @endif>Right
                                        </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Wallet Name:</strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="walletName"
                                            value="{{ config('appSettings.walletName') }}"
                                            placeholder="Enter the name of your wallet system (Eg: Coins, PiggyBank)">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Minimum Payout for Store in
                                    {{ config('appSettings.currencyFormat') }}: </strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg min-payout" name="minPayout"
                                            value="{{ config('appSettings.minPayout') }}"
                                            placeholder="Minimum Payout for Store in {{ config('appSettings.currencyFormat') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Max Time for Accept Order:
                                    </strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg threshold-time"
                                            name="restaurantAcceptTimeThreshold"
                                            value="{{ config('appSettings.restaurantAcceptTimeThreshold') }}">
                                        <span class="help-text small">Maximum time in minutes after which admin
                                        gets notification in the orders page that the store owner has not
                                        accepted the order.</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Max Time for Accept Delivery:
                                    </strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg threshold-time"
                                            name="deliveryAcceptTimeThreshold"
                                            value="{{ config('appSettings.deliveryAcceptTimeThreshold') }}">
                                        <span class="help-text small">Maximum time in minutes after which admin
                                        gets notification in the orders page that the delivery guy has not accepted
                                        the order.</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Upload Image Quality:</strong></label>
                                    <div class="col-lg-9">
                                        <select name="uploadImageQuality" class="form-control form-control-lg select">
                                        <option value="25" @if(config('appSettings.uploadImageQuality')=="25" )
                                        selected @endif>Low</option>
                                        <option value="50" @if(config('appSettings.uploadImageQuality')=="50" )
                                        selected @endif>Medium</option>
                                        <option value="75" @if(config('appSettings.uploadImageQuality')=="75" )
                                        selected @endif>Standard</option>
                                        <option value="100" @if(config('appSettings.uploadImageQuality')=="100" )
                                        selected @endif>Best</option>
                                        </select>
                                        <span class="help-text small">Only for Items upload via Admin and Store Dashboard.</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Allow Payment Gateway Selection for Store Owners  <i class="icon-question3 ml-1" data-popup="tooltip" title="Enabling this will allow the Store Owners to enable payment gateways of their choice from the list of active payment gateways." data-placement="top"></i></strong> </label>
                                    <div class="col-lg-9">
                                        <div class="checkbox checkbox-switchery mt-2">
                                            <label>
                                            <input value="true" type="checkbox" class="switchery-primary"
                                            @if(config('appSettings.allowPaymentGatewaySelection')=="true") checked="checked" @endif
                                            name="allowPaymentGatewaySelection">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <hr style="border-top: 3px dashed rgba(103, 58, 183, 0.20);">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Development Mode
                                    </strong></label>
                                    <div class="col-lg-9">
                                        <div class="checkbox checkbox-switchery mt-2">
                                            <label>
                                            <input value="true" type="checkbox" class="switchery-primary"
                                            @if(config('appSettings.enDevMode')=="true" ) checked="checked" @endif
                                            name="enDevMode">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="seoSettings">
                                <legend class="font-weight-semibold text-uppercase font-size-sm">
                                    SEO Settings
                                </legend>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Meta Title: </strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="seoMetaTitle"
                                            value="{{ config('appSettings.seoMetaTitle') }}" placeholder="Meta Title">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Meta Description: </strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg"
                                            name="seoMetaDescription"
                                            value="{{ config('appSettings.seoMetaDescription') }}"
                                            placeholder="Meta Description">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Open Graph Title: </strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="seoOgTitle"
                                            value="{{ config('appSettings.seoOgTitle') }}" placeholder="Open Graph Title">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Open Graph Description:
                                    </strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="seoOgDescription"
                                            value="{{ config('appSettings.seoOgDescription') }}"
                                            placeholder="Open Graph Meta Description">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    @if(config('appSettings.seoOgImage') !== NULL)
                                    <div class="col-lg-9 offset-lg-3">
                                        <img src="{{ substr(url('/'), 0, strrpos(url('/'), '/')) }}/assets/img/social/{{ config('appSettings.seoOgImage') }}"
                                            alt="Open Graph Image" class="img-fluid mb-2" style="width: 30%;">
                                    </div>
                                    @endif
                                    <label class="col-lg-3 col-form-label"><strong>Open Graph Image: </strong></label>
                                    <div class="col-lg-9">
                                        <input type="file" class="form-control-uniform" name="seoOgImage" data-fouc>
                                        <span class="help-text small">Image dimension 1200x630 </span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Twitter Cards Title:
                                    </strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="seoTwitterTitle"
                                            value="{{ config('appSettings.seoTwitterTitle') }}"
                                            placeholder="Twitter Cards Description">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Twitter Cards
                                    Description</strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg"
                                            name="seoTwitterDescription"
                                            value="{{ config('appSettings.seoTwitterDescription') }}"
                                            placeholder="Twitter Cards Description">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    @if(config('appSettings.seoTwitterImage') !== NULL)
                                    <div class="col-lg-9 offset-lg-3">
                                        <img src="{{ substr(url('/'), 0, strrpos(url('/'), '/')) }}/assets/img/social/{{ config('appSettings.seoTwitterImage') }}"
                                            alt="Twitter Image" class="img-fluid mb-2" style="width: 30%;">
                                    </div>
                                    @endif
                                    <label class="col-lg-3 col-form-label"><strong>Twitter Cards Image:
                                    </strong></label>
                                    <div class="col-lg-9">
                                        <input type="file" class="form-control-uniform" name="seoTwitterImage"
                                            data-fouc>
                                        <span class="help-text small">Image dimension 600x335</span>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="designSettings">
                                <legend class="font-weight-semibold text-uppercase font-size-sm">
                                    Design Settings
                                </legend>
                                <div class="form-group row">
                                    @if(config('appSettings.storeLogo') !== NULL)
                                    <div class="col-lg-9 offset-lg-3">
                                        <img src="{{ substr(url('/'), 0, strrpos(url('/'), '/')) }}/assets/img/logos/{{ config('appSettings.storeLogo') }}"
                                            alt="logo" class="img-fluid mb-2" style="width: 135px;">
                                    </div>
                                    @endif
                                    <label class="col-lg-3 col-form-label"><strong>Logo: </strong></label>
                                    <div class="col-lg-9">
                                        <input type="file" class="form-control-uniform" name="logo" accept="image/x-png" data-fouc>
                                        <span class="help-text small">Image dimension 320x108 - (PNG image only)</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    @if(config('appSettings.favicon-32x32') !== NULL)
                                    <div class="col-lg-9 offset-lg-3">
                                        <img src="{{ substr(url('/'), 0, strrpos(url('/'), '/')) }}/assets/img/favicons/{{ config('appSettings.favicon-96x96') }}"
                                            alt="favicon-96x96" class="img-fluid mb-2" style="width: 70px;">
                                    </div>
                                    @endif
                                    <label class="col-lg-3 col-form-label"><strong>Favicon: </strong></label>
                                    <div class="col-lg-9">
                                        <input type="file" class="form-control-uniform" name="favicon" accept="image/x-png" data-fouc>
                                        <span class="help-text small">Image dimension 512x512 (PNG image only)</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    @if(config('appSettings.splashLogo') !== NULL)
                                    <div class="col-lg-9 offset-lg-3">
                                        <img src="{{ substr(url('/'), 0, strrpos(url('/'), '/')) }}/assets/img/splash/{{ config('appSettings.splashLogo') }}"
                                            alt="splash screen" class="img-fluid mb-2" style="width: 30%;">
                                    </div>
                                    @endif
                                    <label class="col-lg-3 col-form-label"><strong>Splash Screen: </strong></label>
                                    <div class="col-lg-9">
                                        <input type="file" class="form-control-uniform" name="splashLogo" accept="image/jpeg" data-fouc>
                                        <span class="help-text small">Image dimension 480x853 (JPG image only)</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    @if(config('appSettings.firstScreenHeroImage') !== NULL)
                                    <div class="col-lg-9 offset-lg-3">
                                        <img src="{{ substr(url('/'), 0, strrpos(url('/'), '/')) }}/{{ config('appSettings.firstScreenHeroImage') }}"
                                            alt="Hero Image" class="img-fluid mb-2" style="width: 30%;">
                                    </div>
                                    @endif
                                    <label class="col-lg-3 col-form-label"><strong>Hero Image: </strong></label>
                                    <div class="col-lg-9">
                                        <input type="file" class="form-control-uniform" name="firstScreenHeroImage"
                                            data-fouc>
                                        <span class="help-text small">Image dimension 592x640 </span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Store Color:</strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control colorpicker-show-input" name="storeColor"
                                            data-preferred-format="rgb" value="{{ config('appSettings.storeColor') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Cart Background
                                    Color:</strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control colorpicker-show-input"
                                            name="cartColorBg" data-preferred-format="rgb"
                                            value="{{ config('appSettings.cartColorBg') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Cart Text Color:</strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control colorpicker-show-input"
                                            name="cartColorText" data-preferred-format="rgb"
                                            value="{{ config('appSettings.cartColorText') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>New Item Badge
                                    Color:</strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control colorpicker-show-input"
                                            name="newBadgeColor" data-preferred-format="rgb"
                                            value="{{ config('appSettings.newBadgeColor') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Popular Item Badge
                                    Color:</strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control colorpicker-show-input"
                                            name="popularBadgeColor" data-preferred-format="rgb"
                                            value="{{ config('appSettings.popularBadgeColor') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Recommended Item Badge
                                    Color:</strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control colorpicker-show-input"
                                            name="recommendedBadgeColor" data-preferred-format="rgb"
                                            value="{{ config('appSettings.recommendedBadgeColor') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pushNotificationSettings">
                                <legend class="font-weight-semibold text-uppercase font-size-sm">
                                    Customer/Delivery Application Push Notification (<b class="text-warning">Firebase</b>)
                                </legend>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Enable Push
                                    Notifications</strong></label>
                                    <div class="col-lg-9">
                                        <div class="checkbox checkbox-switchery mt-2">
                                            <label>
                                            <input value="true" type="checkbox" class="switchery-primary"
                                            @if(config('appSettings.enablePushNotification')=="true" )
                                            checked="checked" @endif name="enablePushNotification">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Push Notifications for Order
                                    Updates</strong></label>
                                    <div class="col-lg-9">
                                        <div class="checkbox checkbox-switchery mt-2">
                                            <label>
                                            <input value="true" type="checkbox" class="switchery-primary"
                                            @if(config('appSettings.enablePushNotificationOrders')=="true" )
                                            checked="checked" @endif name="enablePushNotificationOrders">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Firebase Sender ID:</strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="firebaseSenderId"
                                            value="{{ config('appSettings.firebaseSenderId') }}"
                                            placeholder="Enter Firebase Sender ID">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Firebase Web Push
                                    Certificate:</strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="firebasePublic"
                                            value="{{ config('appSettings.firebasePublic') }}"
                                            placeholder="Enter Firebase Public Key (Certificate)">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Firebase Server Key:</strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="firebaseSecret"
                                            value="{{ config('appSettings.firebaseSecret') }}"
                                            placeholder="Enter Firebase Secret">
                                        <p class="text-default"><strong>Note: </strong> Do not paste a legacy server key.
                                        </p>
                                    </div>
                                </div>
                                <span class="help-text"><a
                                    href="https://docs.foodomaa.com/configurations/push-notification-keys"
                                    target="_blank">How to configure Push Notifiactions? </a></span>
                                <br>
                                <span><strong class="text-danger">IMPORTANT</strong> To learn how Subscribers, Push Notifications, and Alerts work <a href="https://docs.foodomaa.com/faqs/push-notifications-and-alerts" target="_blank"><b>Click Here</b> </a></span>
                                <hr>
                                <div class="mt-4"></div>
                                <legend class="font-weight-semibold text-uppercase font-size-sm">
                                    Store Dashboard Push Notification (<b class="text-warning">OneSignal</b>)
                                </legend>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>OneSignal App ID:</strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="oneSignalAppId"
                                            value="{{ config('appSettings.oneSignalAppId') }}"
                                            placeholder="Enter OneSignal App ID">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>OneSignal Rest API Key:</strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="oneSignalRestApiKey"
                                            value="{{ config('appSettings.oneSignalRestApiKey') }}"
                                            placeholder="Enter OneSignal Rest API Key">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>New Order Push Notification Message:</strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="restaurantNewOrderNotificationMsg"
                                            value="{{ config('appSettings.restaurantNewOrderNotificationMsg') }}"
                                            placeholder="New Order Push Notification Message">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="socialLoginSettings">
                                <legend class="font-weight-semibold text-uppercase font-size-sm">
                                    Social Login Settings
                                </legend>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Enable Facebook
                                    Login</strong></label>
                                    <div class="col-lg-9">
                                        <div class="checkbox checkbox-switchery mt-2">
                                            <label>
                                            <input value="true" type="checkbox" class="switchery-primary"
                                            @if(config('appSettings.enableFacebookLogin')=="true" )
                                            checked="checked" @endif name="enableFacebookLogin">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Facebook App ID:</strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="facebookAppId"
                                            value="{{ config('appSettings.facebookAppId') }}"
                                            placeholder="Enter Facebook App ID">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Facebook Login Button
                                    Text:</strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg"
                                            name="facebookLoginButtonText"
                                            value="{{ config('appSettings.facebookLoginButtonText') }}"
                                            placeholder="Facebook Login Button Text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Enable Google Login</strong></label>
                                    <div class="col-lg-9">
                                        <div class="checkbox checkbox-switchery mt-2">
                                            <label>
                                            <input value="true" type="checkbox" class="switchery-primary"
                                            @if(config('appSettings.enableGoogleLogin')=="true" ) checked="checked"
                                            @endif name="enableGoogleLogin">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Google App ID:</strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="googleAppId"
                                            value="{{ config('appSettings.googleAppId') }}"
                                            placeholder="Enter Google App ID">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Google Login Button
                                    Text:</strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg"
                                            name="googleLoginButtonText"
                                            value="{{ config('appSettings.googleLoginButtonText') }}"
                                            placeholder="Google Login Button Text">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="mapSettings">
                                <legend class="font-weight-semibold text-uppercase font-size-sm">
                                    Google Map Settings
                                </legend>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Show Map on Order Tracking Page?</strong></label>
                                    <div class="col-lg-9">
                                        <div class="checkbox checkbox-switchery mt-2">
                                            <label>
                                            <input value="true" type="checkbox" class="switchery-primary"
                                            @if(config('appSettings.showMap')=="true" ) checked="checked" @endif
                                            name="showMap">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Google Map API Key: </strong> <br>
                                    (with HTTP Restriction)</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="googleApiKey"
                                            value="{{ config('appSettings.googleApiKey') }}"
                                            placeholder="Google Map API Key which has HTTP Restrictions">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Google Map API Key: </strong> <br>
                                    (with IP Restriction)</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="googleApiKeyIP"
                                            value="{{ config('appSettings.googleApiKeyIP') }}"
                                            placeholder="Google Map API Key which has IP Restrictions">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Google Map API Key: </strong> <br>
                                                    (with no IP/HTTP Restriction)</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="googleApiKeyNoRestriction" placeholder="Google Map API Key which has no IP & HTTP Restrictions"
                                            value="{{ config('appSettings.googleApiKeyNoRestriction') }}">
                                    </div>
                                </div>

                                <hr>
                                <a href="https://stackcanyon.com/docs/foodomaa/admin-google-maps-api" target="_blank" rel="nofollow">Click Here</a>
                                to learn how to setup Google API Keys.<br>
                            </div>
                            <div class="tab-pane fade" id="paymentGatewaySettings">
                                <legend class="font-weight-semibold text-uppercase font-size-sm">
                                    Payment Gateway Settings
                                </legend>
                                @php
                                $activePaymentGatewayCount = count($activePaymentGateways);
                                @endphp
                                @foreach($paymentGateways as $paymentGateway)
                                <div class="form-group row" id="paymentGatewaysData">
                                    <label class="col-lg-6 col-form-label"><strong>{{ $paymentGateway->name }}
                                    </strong>({{ $paymentGateway->description }})</label>
                                    <div class="col-lg-6 mt-2">
                                        <label>
                                        <input value="{{ $paymentGateway->id }}" type="checkbox"
                                        class="switchery-primary payment-gateway-switch"
                                        @if($paymentGateway->is_active && $activePaymentGatewayCount == 1)
                                        checked="checked"
                                        disabled="disabled"
                                        @endif
                                        @if($paymentGateway->is_active)
                                        checked="checked"
                                        @endif
                                        name="{{ $paymentGateway->name }}">
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                                <hr>
                                <h2> <img src="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/img/various/stripe.png" alt="Stripe" style="width: 35px"> Stripe</h2>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Stripe Public Key:</strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="stripePublicKey"
                                            value="{{ config('appSettings.stripePublicKey') }}"
                                            placeholder="Stripe Public Key (Leave blank if not using Stripe)">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Stripe Secret Key:</strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="stripeSecretKey"
                                            value="{{ config('appSettings.stripeSecretKey') }}"
                                            placeholder="Stripe Secret Key (Leave blank if not using Stripe)">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">
                                    <strong>Stripe Language:</strong>
                                    </label>
                                    <div class="col-lg-9">
                                        <select name="stripeLocale" class="form-control form-control-lg select">
                                        <option value="auto" @if(config('appSettings.stripeLocale')=="auto") selected @endif >Stripe detects the langauge of the browser</option>
                                        <option value="cs" @if(config('appSettings.stripeLocale')=="cs") selected @endif >Czech (Czech Republic)</option>
                                        <option value="da" @if(config('appSettings.stripeLocale')=="da") selected @endif >Danish</option>
                                        <option value="de" @if(config('appSettings.stripeLocale')=="de") selected @endif >German (Germany)</option>
                                        <option value="el" @if(config('appSettings.stripeLocale')=="el") selected @endif >Greek (Greece)</option>
                                        <option value="et" @if(config('appSettings.stripeLocale')=="et") selected @endif >Estonian (Estonia)</option>
                                        <option value="en" @if(config('appSettings.stripeLocale')=="en") selected @endif >English</option>
                                        <option value="es" @if(config('appSettings.stripeLocale')=="es") selected @endif >Spanish (Spain)</option>
                                        <option value="es-419" @if(config('appSettings.stripeLocale')=="es-419") selected @endif >Spanish (Latin America)</option>
                                        <option value="fi" @if(config('appSettings.stripeLocale')=="fi") selected @endif >Finnish (Finland)</option>
                                        <option value="fr" @if(config('appSettings.stripeLocale')=="fr") selected @endif >French (France)</option>
                                        <option value="hu" @if(config('appSettings.stripeLocale')=="hu") selected @endif >Hungarian (Hungary)</option>
                                        <option value="id" @if(config('appSettings.stripeLocale')=="id") selected @endif >Indonesian (Indonesia)</option>
                                        <option value="it" @if(config('appSettings.stripeLocale')=="it") selected @endif >Italian (Italy)</option>
                                        <option value="ja" @if(config('appSettings.stripeLocale')=="ja") selected @endif >Japanese</option>
                                        <option value="lt" @if(config('appSettings.stripeLocale')=="lt") selected @endif >Lithuanian (Lithuania)</option>
                                        <option value="lv" @if(config('appSettings.stripeLocale')=="lv") selected @endif >Latvian (Latvia)</option>
                                        <option value="ms" @if(config('appSettings.stripeLocale')=="ms") selected @endif >Malay (Malaysia)</option>
                                        <option value="mt" @if(config('appSettings.stripeLocale')=="mt") selected @endif >Maltese (Malta)</option>
                                        <option value="nb" @if(config('appSettings.stripeLocale')=="nb") selected @endif >Norwegian Bokmål</option>
                                        <option value="nl" @if(config('appSettings.stripeLocale')=="nl") selected @endif >Dutch (Netherlands)</option>
                                        <option value="pl" @if(config('appSettings.stripeLocale')=="pl") selected @endif >Polish (Poland)</option>
                                        <option value="pt-BR" @if(config('appSettings.stripeLocale')=="pt-BR") selected @endif >Portuguese (Brazil)</option>
                                        <option value="pt" @if(config('appSettings.stripeLocale')=="pt") selected @endif >Portuguese (Brazil)</option>
                                        <option value="ro" @if(config('appSettings.stripeLocale')=="ro") selected @endif >Romanian (Romania)</option>
                                        <option value="ru" @if(config('appSettings.stripeLocale')=="ru") selected @endif >Russian (Russia)</option>
                                        <option value="sk" @if(config('appSettings.stripeLocale')=="sk") selected @endif >Slovak (Slovakia)</option>
                                        <option value="sl" @if(config('appSettings.stripeLocale')=="sl") selected @endif >Slovenian (Slovenia)</option>
                                        <option value="sv" @if(config('appSettings.stripeLocale')=="sv") selected @endif >Swedish (Sweden)</option>
                                        <option value="tk" @if(config('appSettings.stripeLocale')=="tk") selected @endif >Turkish (Turkey)</option>
                                        <option value="zh" @if(config('appSettings.stripeLocale')=="zh") selected @endif >Chinese Simplified (China)</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Show Stripe Postal Code Input</strong></label>
                                    <div class="col-lg-9">
                                        <div class="checkbox checkbox-switchery mt-2">
                                            <label>
                                            <input value="true" type="checkbox" class="switchery-primary"
                                            @if(config('appSettings.stripeCheckoutPostalCode')=="true" ) checked="checked" @endif
                                            name="stripeCheckoutPostalCode">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Stripe Ideal Payment</strong></label>
                                    <div class="col-lg-9">
                                        <div class="checkbox checkbox-switchery mt-2">
                                            <label>
                                            <input value="true" type="checkbox" class="switchery-primary"
                                            @if(config('appSettings.stripeAcceptIdealPayment')=="true" ) checked="checked" @endif
                                            name="stripeAcceptIdealPayment">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Stripe FPX Payment</strong></label>
                                    <div class="col-lg-9">
                                        <div class="checkbox checkbox-switchery mt-2">
                                            <label>
                                            <input value="true" type="checkbox" class="switchery-primary"
                                            @if(config('appSettings.stripeAcceptFpxPayment')=="true" ) checked="checked" @endif
                                            name="stripeAcceptFpxPayment">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <hr>
                                <h2> <img src="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/img/various/paypal.png" alt="PayPal" style="width: 35px"> PayPal</h2>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Paypal Environment:</strong></label>
                                    <div class="col-lg-9">
                                        <select name="paypalEnv" class="form-control form-control-lg select">
                                        <option value="sandbox" @if(config('appSettings.paypalEnv')=="sandbox" )
                                        selected @endif>Sandbox (Testing)</option>
                                        <option value="production" @if(config('appSettings.paypalEnv')=="production" )
                                        selected @endif>Production (Live)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Paypal Sandbox Key:</strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="paypalSandboxKey"
                                            value="{{ config('appSettings.paypalSandboxKey') }}"
                                            placeholder="Paypal Sandbox Client Key (Leave blank if not using PayPal)">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Paypal Production
                                    Key:</strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg"
                                            name="paypalProductionKey"
                                            value="{{ config('appSettings.paypalProductionKey') }}"
                                            placeholder="Paypal Production Client Key (Leave blank if not using PayPal)">
                                    </div>
                                </div>
                                <hr>
                                <h2> <img src="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/img/various/paystack.png" alt="PayStack" style="width: 35px"> PayStack</h2>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>PayStack Public Key:</strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="paystackPublicKey"
                                            value="{{ config('appSettings.paystackPublicKey') }}"
                                            placeholder="PayStack Public Key (Leave blank if not using PayStack)">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>PayStack Private
                                    Key:</strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg"
                                            name="paystackPrivateKey"
                                            value="{{ config('appSettings.paystackPrivateKey') }}"
                                            placeholder="PayStack Private Key (Leave blank if not using PayStack)">
                                    </div>
                                </div>
                                <hr>
                                <h2> <img src="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/img/various/razorpay.png" alt="Razorpay" style="width: 35px"> Razorpay</h2>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Razorpay Key Id:</strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="razorpayKeyId"
                                            value="{{ config('appSettings.razorpayKeyId') }}"
                                            placeholder="Razorpay Key Id (Leave blank if not using Razorpay)">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Razorpay Secret Key:</strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="razorpayKeySecret"
                                            value="{{ config('appSettings.razorpayKeySecret') }}"
                                            placeholder="Razorpay Secret Key (Leave blank if not using Razorpay)">
                                    </div>
                                </div>
                                <hr>
                                <h2> <img src="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/img/various/paymongo.png" alt="PayMongo" style="width: 35px"> PayMongo</h2>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>PayMongo Public Key:</strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="paymongoPK"
                                            value="{{ config('appSettings.paymongoPK') }}"
                                            placeholder="PayMongo Public Key (Leave blank if not using PayMongo)">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>PayMongo Secret Key:</strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="paymongoSK"
                                            value="{{ config('appSettings.paymongoSK') }}"
                                            placeholder="PayMongo Secret Key (Leave blank if not using PayMongo)">
                                    </div>
                                </div>
                                <hr>
                                
                                <h2> <img src="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/img/various/mercadopago.png" alt="MercadoPago" style="width: 35px"> MercadoPago</h2>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>MercadoPago Access Token:</strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="mercadopagoAccessToken"
                                            value="{{ config('appSettings.mercadopagoAccessToken') }}"
                                            placeholder="MercadoPago Access Token">
                                            <span class="text-muted">Get Access token from here: <a href="https://www.mercadopago.com.br/developers/panel/credentials" target="_blank">https://www.mercadopago.com.br/developers/panel/credentials</a></span>
                                    </div>
                                </div>

                                <hr>

                                <h2> <img src="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/img/various/paytm.png" alt="Paytm" style="width: 35px"> Paytm</h2>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Paytm Environment:</strong></label>
                                    <div class="col-lg-9">
                                        <select name="paytm_environment" class="form-control form-control-lg select">
                                        <option @if(config('appSettings.paytm_environment') == "local" ) selected @endif value="local">Local</option>
                                        <option @if(config('appSettings.paytm_environment') == "production" ) selected @endif value="production">Production</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Paytm Merchant ID:</strong></label>
                                    <div class="col-lg-9">
                                         <input type="text" class="form-control form-control-lg" name="paytm_merchant_id"
                                            value="{{ config('appSettings.paytm_merchant_id') }}"
                                            placeholder="Paytm Merchant ID">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Paytm Merchant Key:</strong></label>
                                    <div class="col-lg-9">
                                         <input type="text" class="form-control form-control-lg" name="paytm_merchant_key"
                                            value="{{ config('appSettings.paytm_merchant_key') }}"
                                            placeholder="Paytm Merchant Key">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Paytm Website:</strong></label>
                                    <div class="col-lg-9">
                                         <input type="text" class="form-control form-control-lg" name="paytm_merchant_website"
                                            value="{{ config('appSettings.paytm_merchant_website') }}"
                                            placeholder="Paytm Website">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Paytm Industry Type:</strong></label>
                                    <div class="col-lg-9">
                                         <input type="text" class="form-control form-control-lg" name="paytm_industry_type"
                                            value="{{ config('appSettings.paytm_industry_type') }}"
                                            placeholder="Paytm Industry Type">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Paytm Channel ID (For Website):</strong></label>
                                    <div class="col-lg-9">
                                         <input type="text" class="form-control form-control-lg" name="paytm_channel"
                                            value="{{ config('appSettings.paytm_channel') }}"
                                            placeholder="Paytm Channel ID (For Website)">
                                    </div>
                                </div>

                                <hr>
                                <h2> <img src="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/img/various/flutterwave.png" alt="Flutterwave" style="width: 35px"> Flutterwave</h2>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Flutterwave Public Key:</strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="flutterwavePublicKey"
                                            value="{{ config('appSettings.flutterwavePublicKey') }}"
                                            placeholder="Flutterwave Public Key">
                                            <span class="text-muted">How to get the Public Key: <a href="https://developer.flutterwave.com/docs/api-keys" target="_blank">https://developer.flutterwave.com/docs/api-keys</a></span><br>
                                            <span class="small text-danger font-weight-bold">Make sure you enable the Test Mode on Flutterwave dashboard if you intent to use the Test Public Key</span>
                                    </div>
                                </div>

                                <hr>
                                <h2> <img src="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/img/various/khalti.png" alt="Khalti" style="width: 35px"> Khalti</h2>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Khalti Public Key:</strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="khaltiPublicKey"
                                            value="{{ config('appSettings.khaltiPublicKey') }}"
                                            placeholder="Khalti Public Key"> 
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Khalti Secret Key:</strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="khaltiSecretKey"
                                            value="{{ config('appSettings.khaltiSecretKey') }}"
                                            placeholder="Khalti Secret Key"> 
                                    </div>
                                </div>
                                 <span class="text-muted">How to get the Keys: <a href="https://khalti.com/join/merchant" target="_blank">https://khalti.com/join/merchant</a></span><br>
                                
                            </div>
                            <div class="tab-pane fade" id="smsGatewaySettings">
                                <legend class="font-weight-semibold text-uppercase font-size-sm">
                                    SMS Settings
                                </legend>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Default SMS Gateway</strong></label>
                                    <div class="col-lg-9">
                                        <select name="defaultSmsGateway" class="form-control form-control-lg select">
                                        @foreach($sms_gateways as $sms_gateway)
                                        <option @if(config('appSettings.defaultSmsGateway') == $sms_gateway->id ) selected @endif value="{{$sms_gateway->id}}">{{$sms_gateway->gateway_name}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div id="msg91Settings" class="@if (config('appSettings.defaultSmsGateway') != "1") hidden @endif">
                                <h2>Msg91 Settings</h2>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>MSG91 Auth Key:</strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="msg91AuthKey"
                                            value="{{ config('appSettings.msg91AuthKey') }}" placeholder="MSG91 Auth Key">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>MSG91 Sender Id:</strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="msg91SenderId"
                                            value="{{ config('appSettings.msg91SenderId') }}"
                                            placeholder="MSG91 Sender ID">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>DLT Template ID for OTP message: (only for India)</strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="msg91OtpDltTemplateId"
                                            value="{{ config('appSettings.msg91OtpDltTemplateId') }}"
                                            placeholder="DLT Template ID for OTP message">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>DLT Template ID for Store New Order message: (only for India)</strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="msg91NewOrderDltTemplateId"
                                            value="{{ config('appSettings.msg91NewOrderDltTemplateId') }}"
                                            placeholder="DLT Template ID for New Order message">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>DLT Template ID for Delivery Guy New Order message: (only for India)</strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="msg91NewOrderDeliveryDltTemplateId"
                                            value="{{ config('appSettings.msg91NewOrderDeliveryDltTemplateId') }}"
                                            placeholder="DLT Template ID for New Order message">
                                    </div>
                                </div>
                                <p class="text-danger"><b>MSG91</b> requires DLT registation of Sender ID and all the Messages for sending SMS to India. Contact MSG91 for more info. Or visit: <a href="https://help.msg91.com/article/348-dlt-registration">https://help.msg91.com/article/348-dlt-registration</a></p>
                                <hr>
                            </div>
                            <div id="twilioSettings" class="@if (config('appSettings.defaultSmsGateway') != "2") hidden @endif">
                            <h2>Twilio Settings</h2>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label"><strong>Twilio SID:</strong></label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control form-control-lg" name="twilioSid"
                                        value="{{ config('appSettings.twilioSid') }}" placeholder="Twilio SID">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label"><strong>Twilio Access Token:</strong></label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control form-control-lg" name="twilioAccessToken"
                                        value="{{ config('appSettings.twilioAccessToken') }}"
                                        placeholder="Twilio Access Token">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label"><strong>Twilio Phone Number:</strong></label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control form-control-lg" name="twilioFromPhone"
                                        value="{{ config('appSettings.twilioFromPhone') }}"
                                        placeholder="Twilio Phone Number">
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label"><strong>OTP Verification on
                            Registration</strong></label>
                            <div class="col-lg-9">
                                <div class="checkbox checkbox-switchery mt-2">
                                    <label>
                                    <input value="true" type="checkbox" class="switchery-primary"
                                    @if(config('appSettings.enSOV')=="true" ) checked="checked" @endif
                                    name="enSOV">
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label"><strong>OTP Message:</strong></label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control form-control-lg" name="otpMessage"
                                    value="{{ config('appSettings.otpMessage') }}" placeholder="OTP Message: ">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label"><strong>SMS Notification for Store Owners</strong></label>
                            <div class="checkbox checkbox-switchery mt-2">
                                <div class="col-lg-9">
                                    <label>
                                    <input value="true" type="checkbox" class="switchery-primary"
                                    @if(config('appSettings.smsRestaurantNotify') == "true" ) checked="checked" @endif
                                    name="smsRestaurantNotify">
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label"><strong>Store Owners new order message: </strong></label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control form-control-lg" name="defaultSmsRestaurantMsg"
                                    value="{{ config('appSettings.defaultSmsRestaurantMsg') }}" placeholder="Store Owners new order message">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class=" col-lg-3 col-form-label"><strong>Include Order Value in the SMS</strong></label>
                            <div class="checkbox checkbox-switchery mt-2 ">
                                <div class="col-lg-9">
                                    <label>
                                    <input value="true" type="checkbox" class="switchery-primary"
                                    @if(config('appSettings.smsRestOrderValue') == "true" ) checked="checked" @endif
                                    name="smsRestOrderValue">
                                    </label>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label"><strong>SMS Notification for Delivery Guys</strong></label>
                            <div class="col-lg-9">
                                <div class="checkbox checkbox-switchery mt-2">
                                    <label>
                                    <input value="true" type="checkbox" class="switchery-primary"
                                    @if(config('appSettings.smsDeliveryNotify') == "true" ) checked="checked" @endif
                                    name="smsDeliveryNotify">
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label"><strong>Delivery Guys new order message: </strong></label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control form-control-lg" name="defaultSmsDeliveryMsg"
                                    value="{{ config('appSettings.defaultSmsDeliveryMsg') }}" placeholder="Delivery Guys new order message">
                            </div>
                        </div>
                        <hr>
                        {{-- 
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label"><strong>SMS Notification For Order Status</strong></label>
                            <div class="col-lg-9">
                                <div class="checkbox checkbox-switchery mt-2">
                                    <label>
                                    <input value="true" type="checkbox" class="switchery-primary"
                                    @if(config('appSettings.smsOrderNotify') == "true" ) checked="checked" @endif
                                    name="smsOrderNotify">
                                    </label>
                                </div>
                            </div>
                        </div>
                        <hr>
                        --}}
                    </div>
                    <div class="tab-pane fade" id="emailSettings">
                        <legend class="font-weight-semibold text-uppercase font-size-sm">
                            Email Settings
                        </legend>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label"><strong>Default SMS Gateway</strong></label>
                            <div class="col-lg-9">
                                <select name="defaultEmailGateway" class="form-control form-control-lg select">
                                <option @if(config('appSettings.defaultEmailGateway') == "sendgrid" ) selected @endif value="sendgrid">SendGrid</option>
                                <option @if(config('appSettings.defaultEmailGateway') == "smtp" ) selected @endif value="smtp">Custom SMTP</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div id="sendgridSettings" class="@if (config('appSettings.defaultEmailGateway') != "sendgrid") hidden @endif">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label"><strong>SendGrid Api Key</strong></label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control form-control-lg" name="sendgrid_api_key"
                                    value="{{ config('appSettings.sendgrid_api_key') }}" placeholder="SendGrid API Key">
                            </div>
                        </div>
                    </div>
                    <div id="smtpSettings" class="@if (config('appSettings.defaultEmailGateway') != "smtp") hidden @endif">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label"><strong>SMTP Host</strong></label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control form-control-lg" name="mail_host"
                                value="{{ config('appSettings.mail_host') }}" placeholder="SMTP host">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label"><strong>SMTP Port</strong></label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control form-control-lg" name="mail_port"
                                value="{{ config('appSettings.mail_port') }}" placeholder="SMTP Port">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label"><strong>SMTP Username</strong></label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control form-control-lg" name="mail_username"
                                value="{{ config('appSettings.mail_username') }}" placeholder="SMTP Username">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label"><strong>SMTP Password</strong></label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control form-control-lg" name="mail_password"
                                value="{{ config('appSettings.mail_password') }}" placeholder="SMTP Password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label"><strong>SMTP Encryption</strong></label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control form-control-lg" name="mail_encryption"
                                value="{{ config('appSettings.mail_encryption') }}" placeholder="SMTP Encryption">
                        </div>
                    </div>
            </div>
            <hr>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label"><strong>Send Emails From "Email"</strong></label>
                <div class="col-lg-9">
                    <input type="email" class="form-control form-control-lg" name="sendEmailFromEmailAddress"
                        value="{{ config('appSettings.sendEmailFromEmailAddress') }}"
                        placeholder="Enter an email like do-not-reply@mywebsite.com">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label"><strong>Send Emails From "Name"</strong></label>
                <div class="col-lg-9">
                    <input type="text" class="form-control form-control-lg" name="sendEmailFromEmailName"
                        value="{{ config('appSettings.sendEmailFromEmailName') }}"
                        placeholder="Enter the email address name (Ex: Your website name)">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label"><strong>Password Reset Email "Subject"</strong></label>
                <div class="col-lg-9">
                    <input type="text" class="form-control form-control-lg" name="passwordResetEmailSubject"
                        value="{{ config('appSettings.passwordResetEmailSubject') }}"
                        placeholder="Enter the email subject for password recovery email (Ex: Password Reset)">
                </div>
            </div>
            <div>
                <p><strong class="text-danger">IMPORTANT:</strong> After saving the settings, send a test mail to your email
                    address before you enable the Password Reset Functionality
                </p>
                <button
                    type="button" class="btn btn-primary btn-md" id="toggleSendTestEmail" autocomplete="false"> Send Test
                Email</button>
                <div id="sendTestEmailBlock" style="display: none;">
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <input type="email" class="form-control form-control-lg" id="testEmail"
                                placeholder="Enter your Email Address">
                        </div>
                        <button type="button"
                            class="btn btn-primary btn-labeled btn-labeled-left btn-md"
                            id="sendTestEmailNow">
                        <b><i class="icon-mail-read ml-1"></i></b>
                        Send Test Email
                        <i class="icon-spinner10 spinner ml-1" id="testMailSpinner"
                            style="display: none;"></i>
                        </button>
                    </div>
                </div>
            </div>
            <hr>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label"><strong>Enable Password Reset
                Email?</strong></label>
                <div class="col-lg-9">
                    <div class="checkbox checkbox-switchery mt-2">
                        <label>
                        <input value="true" type="checkbox" class="switchery-primary"
                        @if(config('appSettings.enPassResetEmail')=="true" ) checked="checked"
                        @endif name="enPassResetEmail">
                        </label>
                    </div>
                </div>
            </div>
            <div id="customSMTPDisclaimer" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><span class="font-weight-bold text-danger"> <i class="icon-exclamation mr-2"></i> Important Disclaimer</span></h5>
                        </div>
                        <div class="modal-body">
                            <p>
                                You have selected to use <strong>Custom SMTP Gateway</strong>.
                                <br><br>
                                Only SendGrid API Email Gateway is officially supported. 
                                <br><br>
                                If you configure a Custom SMTP gateway, you will be on your own! 
                                <br>
                                Sending of emails cannot be guaranteed with the Custom SMTP Gateway settings as configurations may vary from server to server.
                                <br><br>
                                <strong>Any support tickets related to Custom SMTP Gateway issues will be <span class="text-danger">closed</span> automatically.</strong>
                            </p>
                        </div>
                        <div class="modal-footer">
                            <div class="text-right">
                                <button type="button" class="btn btn-primary btn-labeled btn-labeled-left btn-lg" data-dismiss="modal">
                                <b><i class="icon-checkmark ml-1"></i></b>
                                I Understand
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <script>
                $('#toggleSendTestEmail').click(function(event) {
                    $(this).hide();
                    $('#sendTestEmailBlock').toggle(500);
                });
                $('#sendTestEmailNow').click(function(event) {
                    let testEmail = $('#testEmail').val();
                    let token = $("#csrf").val();
                    
                    if (testEmail.length) {
                        $('#sendTestEmailNow').addClass('pointer-none');
                        $('#testMailSpinner').toggle();
                        $.ajax({
                            url: '{{ route('admin.sendTestmail') }}',
                            type: 'POST',
                            dataType: 'JSON',
                            data: {email: testEmail, _token: token},
                        })
                        .done(function(data) {
                            $.jGrowl("Please check your inbox.", {
                                position: 'bottom-center',
                                header: 'Mail Sent ✅',
                                theme: 'bg-success',
                                life: '5000'
                            }); 
                            console.log("success");
                            $('#sendTestEmailNow').removeClass('pointer-none');
                            $('#testMailSpinner').toggle();
                        })
                        .fail(function(data) {
                            console.log(data);
                            $.jGrowl(data.responseJSON.message, {
                                position: 'bottom-center',
                                header: 'Wooopsss ⚠️',
                                theme: 'bg-warning',
                                life: '999999'
                            }); 
                            $('#sendTestEmailNow').removeClass('pointer-none');
                            $('#testMailSpinner').toggle();
                        }) 
                    } else {
                        $.jGrowl("Please enter an email address in a correct format.", {
                            position: 'bottom-center',
                            header: 'Wooopsss ⚠️',
                            theme: 'bg-warning',
                            life: '3500'
                        }); 
                    }
                });
            </script>
            <div class="tab-pane fade" id="googleAnalyticsSettings">
                <legend class="font-weight-semibold text-uppercase font-size-sm">
                    Google Analytics Settings
                </legend>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Enable Google
                    Analytics</strong></label>
                    <div class="col-lg-9">
                        <div class="checkbox checkbox-switchery mt-2">
                            <label>
                            <input value="true" type="checkbox" class="switchery-primary"
                            @if(config('appSettings.enableGoogleAnalytics')=="true" )
                            checked="checked" @endif name="enableGoogleAnalytics">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Analytics UA ID:</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="googleAnalyticsId"
                            value="{{ config('appSettings.googleAnalyticsId') }}"
                            placeholder="UA-00000000-00">
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="taxSettings">
                <legend class="font-weight-semibold text-uppercase font-size-sm">
                    Tax Settings
                </legend>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Enable Tax:</strong></label>
                    <div class="col-lg-9">
                        <div class="checkbox checkbox-switchery mt-2">
                            <label>
                            <input value="true" type="checkbox" class="switchery-primary"
                            @if(config('appSettings.taxApplicable')=="true" ) checked="checked"
                            @endif name="taxApplicable">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Tax Percentage:</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="taxPercentage"
                            value="{{ config('appSettings.taxPercentage') }}"
                            placeholder="Tax in Percentage">
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="customerAppSettings">
                <legend class="font-weight-semibold text-uppercase font-size-sm">
                    Customer App Settings
                </legend>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Show Cash Change on COD
                    <span class="badge badge-flat border-grey-800 text-danger text-capitalize mx-1">NEW</span> <i class="icon-question3 ml-1" data-popup="tooltip" title="If enabled, on cash on delivery payments, the customer will be asked to enter amount for the cash change they need." data-placement="top"></i></strong></label>
                    <div class="col-lg-9">
                        <div class="checkbox checkbox-switchery mt-2">
                            <label>
                            <input value="true" type="checkbox" class="switchery-primary"
                            @if(config('appSettings.showCashChange')=="true" )
                            checked="checked" @endif name="showCashChange">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Sort Delivery stores by Distance
                    <span class="badge badge-flat border-grey-800 text-danger text-capitalize mx-1">NEW</span></strong></label>
                    <div class="col-lg-9">
                        <div class="checkbox checkbox-switchery mt-2">
                            <label>
                            <input value="true" type="checkbox" class="switchery-primary"
                            @if(config('appSettings.sortDeliveryStoresByDistance')=="true" )
                            checked="checked" @endif name="sortDeliveryStoresByDistance">
                            </label>
                        </div>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Show PWA Installation Prompt
                    <span class="badge badge-flat border-grey-800 text-danger text-capitalize mx-1">NEW</span> <i class="icon-question3 ml-1" data-popup="tooltip" title="This will show the new PWA Installation Prompt above the footer on the Homepage." data-placement="top"></i></strong></label>
                    <div class="col-lg-9">
                        <div class="checkbox checkbox-switchery mt-2">
                            <label>
                            <input value="true" type="checkbox" class="switchery-primary"
                            @if(config('appSettings.showPwaInstallPromptFooter')=="true" )
                            checked="checked" @endif name="showPwaInstallPromptFooter">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Show Tax/VAT Number on My Accounts Page
                    <span class="badge badge-flat border-grey-800 text-danger text-capitalize mx-1">NEW</span></strong></label>
                    <div class="col-lg-9">
                        <div class="checkbox checkbox-switchery mt-2">
                            <label>
                            <input value="true" type="checkbox" class="switchery-primary"
                            @if(config('appSettings.showCustomerVatNumber')=="true" )
                            checked="checked" @endif name="showCustomerVatNumber">
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Show Addon Prices on Cart
                    <span class="badge badge-flat border-grey-800 text-danger text-capitalize mx-1">NEW</span></strong></label>
                    <div class="col-lg-9">
                        <div class="checkbox checkbox-switchery mt-2">
                            <label>
                            <input value="true" type="checkbox" class="switchery-primary"
                            @if(config('appSettings.showAddonPricesOnCart')=="true" )
                            checked="checked" @endif name="showAddonPricesOnCart">
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Show "Try on Phone" on Desktop View</strong></label>
                    <div class="col-lg-9">
                        <div class="checkbox checkbox-switchery mt-2">
                            <label>
                            <input value="true" type="checkbox" class="switchery-primary"
                            @if(config('appSettings.showTryItOnPhone')=="true" )
                            checked="checked" @endif name="showTryItOnPhone">
                            </label>
                        </div>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Enable Delivery Tip Amount
                    </strong></label>
                    <div class="col-lg-9">
                        <div class="checkbox checkbox-switchery mt-2">
                            <label>
                            <input value="true" type="checkbox" class="switchery-primary"
                            @if(config('appSettings.showTipsAmount')=="true" )
                            checked="checked" @endif name="showTipsAmount">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 col-lg-3 col-form-label">
                        <label><strong>Tip Amount <i class="icon-question3 ml-1" data-popup="tooltip" title="Type any amount and hit Enter on your Keyboard" data-placement="top"> </i></strong></label>
                    </div>
                    <div class="col-md-9 tipss">
                        <select class="tips" name="tips[]" multiple="multiple">
                            @if(isset($tips) && count($tips) > 0)
                            @foreach($tips as $value)
                            <option selected="selected">{{$value}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Enable Delivery Tip Percentage</strong></label>
                    <div class="col-lg-9">
                        <div class="checkbox checkbox-switchery mt-2">
                            <label>
                            <input value="true" type="checkbox" class="switchery-primary"
                            @if(config('appSettings.showTipsPercentage')=="true" )
                            checked="checked" @endif name="showTipsPercentage">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 col-lg-3 col-form-label">
                        <label><strong>Tip Percentage  <i class="icon-question3 ml-1" data-popup="tooltip" title="Type any Percentage Amount and hit Enter on your Keyboard" data-placement="top"> </i> </strong></label>
                    </div>
                    <div class="col-md-9 tipss">
                        <select class="tips_percentage" name="tips_percentage[]" multiple="multiple">
                            @if(isset($tips_percentage) && count($tips_percentage) > 0)
                            @foreach($tips_percentage as $value)
                            <option selected="selected">{{$value}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Show Total Item Quantity on Footer Cart <i class="icon-question3 ml-1" data-popup="tooltip" title="If disabled, the count of unique items on the cart will be shown on the footer" data-placement="top"></i>
                    </strong></label>
                    <div class="col-lg-9">
                        <div class="checkbox checkbox-switchery mt-2">
                            <label>
                            <input value="true" type="checkbox" class="switchery-primary"
                            @if(config('appSettings.countQuantityAsTotalItemsOnCart')=="true" ) checked="checked"
                            @endif name="countQuantityAsTotalItemsOnCart">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Auto Full Address on Location Selection Page <i class="icon-question3 ml-1" data-popup="tooltip" title="Disabling this will only show locality, city, country and pincode on the auto address box" data-placement="top"></i>
                    </strong></label>
                    <div class="col-lg-9">
                        <div class="checkbox checkbox-switchery mt-2">
                            <label>
                            <input value="true" type="checkbox" class="switchery-primary"
                            @if(config('appSettings.googleFullAddress')=="true" ) checked="checked"
                            @endif name="googleFullAddress">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Search Bar on Homepage <i class="icon-question3 ml-1" data-popup="tooltip" title="This will override the default coupon success message" data-placement="top"></i>
                    </strong></label>
                    <div class="col-lg-9">
                        <div class="checkbox checkbox-switchery mt-2">
                            <label>
                            <input value="true" type="checkbox" class="switchery-primary"
                            @if(config('appSettings.mockSearchOnHomepage')=="true" ) checked="checked"
                            @endif name="mockSearchOnHomepage">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Footer Navigation Type
                    </strong></label>
                    <div class="col-lg-9">
                        <select name="footerStyleType" class="form-control form-control-lg select">
                        <option value="FIXED"
                        @if(config('appSettings.footerStyleType')=="FIXED" )
                        selected="selected" @endif>Fixed Style
                        </option>
                        <option value="FLOAT"
                        @if(config('appSettings.footerStyleType')=="FLOAT"
                        ) selected="selected" @endif>Float Style
                        </option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Show Custom iOS Add To Homescreen Popup  <i class="icon-question3 ml-1" data-popup="tooltip" title="Enabling this will display a custom popup on iOS device for Add To Homescreen once per user, 3 seconds after page is loaded." data-placement="top"></i>
                    </strong></label>
                    <div class="col-lg-9">
                        <div class="checkbox checkbox-switchery mt-2">
                            <label>
                            <input value="true" type="checkbox" class="switchery-primary"
                            @if(config('appSettings.enIOSPWAPopup')=="true" ) checked="checked"
                            @endif name="enIOSPWAPopup">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Show Coupon Desctiption on Coupon Success  <i class="icon-question3 ml-1" data-popup="tooltip" title="This will override the default coupon success message" data-placement="top"></i>
                    </strong></label>
                    <div class="col-lg-9">
                        <div class="checkbox checkbox-switchery mt-2">
                            <label>
                            <input value="true" type="checkbox" class="switchery-primary"
                            @if(config('appSettings.showCouponDescriptionOnSuccess')=="true" ) checked="checked"
                            @endif name="showCouponDescriptionOnSuccess">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Use Google Distance Matrix API  <i class="icon-question3 ml-1" data-popup="tooltip" title="Google APIs will be used for calculating the delivery charge if the store has enabled Dynamic Delivery charge" data-placement="top"></i>
                    </strong></label>
                    <div class="col-lg-9">
                        <div class="checkbox checkbox-switchery mt-2">
                            <label>
                            <input value="true" type="checkbox" class="switchery-primary"
                            @if(config('appSettings.enGDMA')=="true" ) checked="checked"
                            @endif name="enGDMA"> 
                            <b><span class="mt-1"><span class="text-danger"> IMPORTANT: </span>Donot enable Google Distance Matrix API without first follow </span> <a href="https://docs.foodomaa.com/configurations/google-distance-matrix-api" target="_blank"> this documentation.</a><br>You will get a loading screen on the Cart page if this documentation is not followed.</b>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Randomize Stores
                    <i class="icon-question3 ml-1" data-popup="tooltip" title="Delivery and Selfpickup stores will be randomized (Sorting order will be ignored) - Postion of the stores on back button press will be changed - So enabling this is NOT Recommended for better User Experience" data-placement="right"></i>
                    </strong></label>
                    <div class="col-lg-9">
                        <div class="checkbox checkbox-switchery mt-2">
                            <label>
                            <input value="true" type="checkbox" class="switchery-primary"
                            @if(config('appSettings.randomizeStores')=="true" )
                            checked="checked" @endif name="randomizeStores">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Show Inactive Items
                    <i class="icon-question3 ml-1" data-popup="tooltip" title="Inactive items will be displayed but Add to Cart button will not be shown" data-placement="left"></i>
                    </strong></label>
                    <div class="col-lg-9">
                        <div class="checkbox checkbox-switchery mt-2">
                            <label>
                            <input value="true" type="checkbox" class="switchery-primary"
                            @if(config('appSettings.showInActiveItemsToo')=="true" )
                            checked="checked" @endif name="showInActiveItemsToo">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Flat/Apartment Mandatory in Address
                    </strong></label>
                    <div class="col-lg-9">
                        <div class="checkbox checkbox-switchery mt-2">
                            <label>
                            <input value="true" type="checkbox" class="switchery-primary"
                            @if(config('appSettings.flatApartmentAddressRequired')=="true" ) checked="checked"
                            @endif name="flatApartmentAddressRequired">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Pin
                    </strong></label>
                    <div class="col-lg-9">
                        <div class="checkbox checkbox-switchery mt-2">
                            <label>
                            <input value="true" type="checkbox" class="switchery-primary"
                            @if(config('appSettings.enableDeliveryPin')=="true" ) checked="checked"
                            @endif name="enableDeliveryPin">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Promo Slider </strong></label>
                    <div class="col-lg-9">
                        <div class="checkbox checkbox-switchery mt-2">
                            <label>
                            <input value="true" type="checkbox" class="switchery-primary"
                            @if(config('appSettings.showPromoSlider')=="true" ) checked="checked"
                            @endif name="showPromoSlider">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Veg/Non-Veg Badge
                    </strong></label>
                    <div class="col-lg-9">
                        <div class="checkbox checkbox-switchery mt-2">
                            <label>
                            <input value="true" type="checkbox" class="switchery-primary"
                            @if(config('appSettings.showVegNonVegBadge')=="true" )
                            checked="checked" @endif name="showVegNonVegBadge">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Beautify Date/Time
                    </strong></label>
                    <div class="col-lg-9">
                        <div class="checkbox checkbox-switchery mt-2">
                            <label>
                            <input value="true" type="checkbox" class="switchery-primary"
                            @if(config('appSettings.showFromNowDate')=="true" )
                            checked="checked" @endif name="showFromNowDate">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Round up Dynamic Delivery Charge
                    </strong></label>
                    <div class="col-lg-9">
                        <div class="checkbox checkbox-switchery mt-2">
                            <label>
                            <input value="true" type="checkbox" class="switchery-primary"
                            @if(config('appSettings.enDelChrRnd')=="true" )
                            checked="checked" @endif name="enDelChrRnd">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Recommended Item Slider
                    </strong></label>
                    <div class="col-lg-9">
                        <div class="checkbox checkbox-switchery mt-2">
                            <label>
                            <input value="true" type="checkbox" class="switchery-primary"
                            @if(config('appSettings.recommendedLayoutV2')=="true" )
                            checked="checked" @endif name="recommendedLayoutV2">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Expand All Items Menu
                    </strong></label>
                    <div class="col-lg-9">
                        <div class="checkbox checkbox-switchery mt-2">
                            <label>
                            <input value="true" type="checkbox" class="switchery-primary"
                            @if(config('appSettings.expandAllItemMenu')=="true" )
                            checked="checked" @endif name="expandAllItemMenu">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>GDPR Checkbox</strong></label>
                    <div class="col-lg-9">
                        <div class="checkbox checkbox-switchery mt-2">
                            <label>
                            <input value="true" type="checkbox" class="switchery-primary"
                            @if(config('appSettings.showGdpr')=="true" ) checked="checked" @endif
                            name="showGdpr">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Self Pickup </strong></label>
                    <div class="col-lg-9">
                        <div class="checkbox checkbox-switchery mt-2">
                            <label>
                            <input value="true" type="checkbox" class="switchery-primary"
                            @if(config('appSettings.enSPU')=="true" ) checked="checked" @endif
                            name="enSPU">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Sort Self Pickup stores by Distance</strong></label>
                    <div class="col-lg-9">
                        <div class="checkbox checkbox-switchery mt-2">
                            <label>
                            <input value="true" type="checkbox" class="switchery-primary"
                            @if(config('appSettings.sortSelfpickupStoresByDistance')=="true" ) checked="checked" @endif
                            name="sortSelfpickupStoresByDistance">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Default Country Code on Phone field:
                    </strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="phoneCountryCode"
                            value="{{ config('appSettings.phoneCountryCode') }}"
                            placeholder="Default Country Code on Phone field (Leave empty if not required)">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Hide Item Price when Zero
                    </strong></label>
                    <div class="col-lg-9">
                        <div class="checkbox checkbox-switchery mt-2">
                            <label>
                            <input value="true" type="checkbox" class="switchery-primary"
                            @if(config('appSettings.hidePriceWhenZero')=="true" ) checked="checked"
                            @endif name="hidePriceWhenZero">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Show Product Discount Percentage
                    </strong></label>
                    <div class="col-lg-9">
                        <div class="checkbox checkbox-switchery mt-2">
                            <label>
                            <input value="true" type="checkbox" class="switchery-primary"
                            @if(config('appSettings.showPercentageDiscount')=="true" )
                            checked="checked" @endif name="showPercentageDiscount">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Use Simple Spinner for Loading Pages
                    </strong></label>
                    <div class="col-lg-9">
                        <div class="checkbox checkbox-switchery mt-2">
                            <label>
                            <input value="true" type="checkbox" class="switchery-primary"
                            @if(config('appSettings.useSimpleSpinner')=="true" )
                            checked="checked" @endif name="useSimpleSpinner">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="deliveryAppSettings">
                <legend class="font-weight-semibold text-uppercase font-size-sm">
                    Delivery Settings
                </legend>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Enable Delivery Guy's Earnings
                    </strong></label>
                    <div class="col-lg-9">
                        <div class="checkbox checkbox-switchery mt-2">
                            <label>
                            <input value="true" type="checkbox" class="switchery-primary"
                            @if(config('appSettings.enableDeliveryGuyEarning')=="true" )
                            checked="checked" @endif name="enableDeliveryGuyEarning">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Guy's Earning From
                    </strong></label>
                    <div class="col-lg-9">
                        <select name="deliveryGuyCommissionFrom" class="form-control form-control-lg select">
                        <option value="FULLORDER"
                        @if(config('appSettings.deliveryGuyCommissionFrom')=="FULLORDER" )
                        selected="selected" @endif>Commission from Full Order Value
                        </option>
                        <option value="DELIVERYCHARGE"
                        @if(config('appSettings.deliveryGuyCommissionFrom')=="DELIVERYCHARGE"
                        ) selected="selected" @endif>Commission from Delivery Charge
                        Value</option>
                        </select>
                    </div>
                </div>
                {{-- 
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Show full address on Order List
                    </strong></label>
                    <div class="col-lg-9">
                        <div class="checkbox checkbox-switchery mt-2">
                            <label>
                            <input value="true" type="checkbox" class="switchery-primary"
                            @if(config('appSettings.showDeliveryFullAddressOnList')=="true" ) checked="checked"
                            @endif name="showDeliveryFullAddressOnList">
                            </label>
                        </div>
                    </div>
                </div>
                --}}
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Show Customer Address
                    </strong></label>
                    <div class="col-lg-9">
                        <div class="checkbox checkbox-switchery mt-2">
                            <label>
                            <input value="true" type="checkbox" class="switchery-primary"
                            @if(config('appSettings.showUserInfoBeforePickup')=="true" ) checked="checked"
                            @endif name="showUserInfoBeforePickup">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Show Order Addons
                    </strong></label>
                    <div class="col-lg-9">
                        <div class="checkbox checkbox-switchery mt-2">
                            <label>
                            <input value="true" type="checkbox" class="switchery-primary"
                            @if(config('appSettings.showOrderAddonsDelivery')=="true" ) checked="checked"
                            @endif name="showOrderAddonsDelivery">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Show Item Price, Total & Comments
                    </strong></label>
                    <div class="col-lg-9">
                        <div class="checkbox checkbox-switchery mt-2">
                            <label>
                            <input value="true" type="checkbox" class="switchery-primary"
                            @if(config('appSettings.showPriceAndOrderCommentsDelivery')=="true" ) checked="checked"
                            @endif name="showPriceAndOrderCommentsDelivery">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Show Delivery Guy's COD Collection 
                    </strong></label>
                    <div class="col-lg-9">
                        <div class="checkbox checkbox-switchery mt-2">
                            <label>
                            <input value="true" type="checkbox" class="switchery-primary"
                            @if(config('appSettings.showDeliveryCollection')=="true" )
                            checked="checked" @endif name="showDeliveryCollection">
                            </label>
                        </div>
                    </div>
                </div>
                <p><strong class="text-danger">Important Note: </strong> You will need to logout of the delivery application and login again to get the updated congigs/settings.</p>
            </div>
            <div class="tab-pane fade" id="restaurantDashboardSettings">
                <legend class="font-weight-semibold text-uppercase font-size-sm">
                    Store Dashboard Settings
                </legend>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>New Order Fetch Rate:</strong></label>
                    <div class="col-lg-9">
                        <select name="restaurantNewOrderRefreshRate" class="form-control form-control-lg select">
                        <option value="5" @if(config('appSettings.restaurantNewOrderRefreshRate') == "5") selected @endif>Fetch Every 5 Seconds</option>
                        <option value="15" @if(config('appSettings.restaurantNewOrderRefreshRate') == "15") selected @endif>Fetch Every 15 Seconds</option>
                        <option value="25" @if(config('appSettings.restaurantNewOrderRefreshRate') == "25") selected @endif>Fetch Every 25 Seconds</option>
                        <option value="30" @if(config('appSettings.restaurantNewOrderRefreshRate') == "30") selected @endif>Fetch Every 30 Seconds</option>
                        </select>
                        <span class="help-text small mt-2"> The lesser the value, the more load on the server. Recommended is <strong>15 Seconds </strong></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Notification Tone:</strong></label>
                    <div class="col-lg-9">
                        <select name="restaurantNotificationAudioTrack" class="form-control form-control-lg select" id="restaurantNotificationTone">
                        @foreach($notificationAudioFileNames as $audioFileName)
                        <option value="{{ $audioFileName }}" @if(config('appSettings.restaurantNotificationAudioTrack') == $audioFileName) selected
                        @endif>{{ $audioFileName }}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="customCSS">
                <legend class="font-weight-semibold text-uppercase font-size-sm">
                    Custom CSS
                </legend>
                <p>Below code will affect the styling for the Customer Application & the Delivery
                    Application
                </p>
                <div id="css_editor1">{{ config('appSettings.customCSS') }}</div>
                <textarea style="display: none" class="form-control" name="customCSS" rows="5"
                    placeholder="Your CSS code goes here...">{{ config('appSettings.customCSS') }}</textarea>
            </div>
            <div class="tab-pane fade" id="cacheSettings">
                <legend class="font-weight-semibold text-uppercase font-size-sm">
                    Cache Settings
                </legend>
                <div class="row">
                    <p class="col-md-3 col-xs-12"><strong>Application Version: </strong></p>
                    <span class="col-md-6 col-xs-12">{{ $versionMsg }}</span>
                </div>
                <div class="row">
                    <p class="col-md-3 col-xs-12"><strong>Cache Hash: </strong></p>
                    <span
                        class="col-md-6 col-xs-12" id="cacheVersion">{{ implode('-', str_split($versionJson->forceCacheClearVersion, 5)) }}</span>
                </div>
                <div class="row">
                    <p class="col-md-3 col-xs-12"><strong>Settings Hash: </strong></p>
                    <span
                        class="col-md-6 col-xs-12" id="settingsVersion">{{ implode('-', str_split($versionJson->forceNewSettingsVersion, 5)) }}</span>
                </div>
                {{-- 
                <div class="row">
                    <p class="col-md-3 col-xs-12"><strong>Logout Hash: </strong></p>
                    <span
                        class="col-md-6 col-xs-12" id="logoutVersion">{{ implode('-', str_split($versionJson->forceLogoutAllCustomers, 5)) }}</span>
                </div>
                --}}
                <hr>
                <h4 class="font-weight-bold">Force Clear Cache</h4>
                <p>This will force clear the
                    cache on their devices and update the application on the user's device.
                </p>
                <a href="javascript:void(0)" data-type="CACHE" data-popup="tooltip"
                    title="Double Click to Execute" data-placement="right"
                    class="btn btn-secondary btn-labeled btn-labeled-left" id="forceClearCache"> <b><i
                    class="icon-arrow-right7"></i></b> Force Clear Cache</a>
                <hr>
                <h4 class="font-weight-bold">Force New Settings</h4>
                <p>This will force update new settings for all the users and delivery guys.</p>
                <a href="javascript:void(0)" data-type="SETTINGS" data-popup="tooltip"
                    title="Double Click to Execute" data-placement="right"
                    class="btn btn-secondary btn-labeled btn-labeled-left" id="forceClearSettings">
                <b><i class="icon-arrow-right7"></i></b> Force New Settings</a>
                <hr>
                {{-- 
                <h4 class="font-weight-bold">Force Logout Customers </h4>
                <p>This will logout all the users on the application (Not for Admin and Store Owners) <br>
                    <b class="text-danger">Proceed with caution</b>
                </p>
                <a href="javascript:void(0)" data-type="LOGOUT" data-popup="tooltip"
                    title="Double Click to Execute" data-placement="right"
                    class="btn btn-secondary btn-labeled btn-labeled-left" id="forceLogoutAllCustomers">
                <b><i class="icon-arrow-right7"></i></b> Force logout customers</a>
                <hr>
                --}}
                <p class="text-danger">
                    The customer app needs to reload the page for these settings to take effect.
                </p>
            </div>
            <div class="tab-pane fade" id="fixUpdateIssues">
                <legend class="font-weight-semibold text-uppercase font-size-sm">
                    Fix Update Issues
                </legend>
                <p>After an update, the front-facing app (for customer or delivery) will have
                    some issues.
                    <br> The issue may be because of:
                </p>
                <ol>
                    <li> Database error because of incorrect URL</li>
                    <li> Cross-Origin Error because of non HTTPS URL</li>
                    <li> Cache issues</li>
                </ol>
                <p><strong>Click the below button to fix these issues.</strong></p>
                <a href="{{ route('admin.fixUpdateIssues') }}" class="btn btn-lg btn-primary" id="fixUpdateIssuesButton">Fix Issues Now</a>
            </div>
            <div class="tab-pane fade" id="advanceSettings">
                <legend class="font-weight-semibold text-uppercase font-size-sm">
                    Advanced Settings
                </legend>
                <h2>Clean Everything</h2>
                <p><strong>What will be removed?</strong></p>
                <ul>
                    <li>All the users (including Store Owners and Delivery Guys) except for the Super Admin</li>
                    <li>All the restaurants</li>
                    <li>All the Item Categories, Items, Addon Categories, Addons</li>
                    <li>All the Orders</li>
                    <li>Store Categories & Category Sliders</li>
                    <li>Promo Sliders and all it's Slides</li>
                    <li>All the wallet and wallet transaction logs</li>
                    <li>All the Store Payouts and Store Payout Logs</li>
                    <li>All the Delivery Collections and Delivery Collection Logs</li>
                    <li>All the users addresses, Delivery Guy GPS Locations</li>
                    <li>Internal data that links to the orders</li>
                </ul>
                <p><strong>What will not be removed?</strong></p>
                <ul>
                    <li>Website Settings</li>
                    <li>Translations data</li>
                    <li>Coupons</li>
                    <li>Pages</li>
                    <li>Popular Geo Locations</li>
                </ul>
                <button type="button" class="btn btn-danger btn-labeled btn-labeled-left"  data-popup="tooltip" title="On click of this button, you will be asked to confirm this action." data-placement="right">
                    <b><i class="icon-trash"></i></b>
                    <span data-toggle="modal" data-target="#cleanEverything">Clean Everything</span>
                </button>
                <hr class="mt-4">

                <div class="mt-5">
                    <p class="text-danger mb-2"><strong>EXPERIMENTAL FEATURES </strong> - no guarantee of work</p>
                    <a href="{{ route('admin.filesBackup') }}" class="btn btn-primary btn-labeled btn-labeled-left backupBtn mr-2">
                    <b><i class="icon-folder-download2"></i></b>
                    Files Backup
                    </a>
                    <a href="{{ route('admin.dbBackup') }}" class="btn btn-primary btn-labeled btn-labeled-left backupBtn">
                    <b><i class="icon-database-time2"></i></b>
                    Database Backup
                    </a>
                    <p class="mt-2"> Please note the backup feature is experimental and the backup doesn't work on all the servers (even if a success message is returned). We will be improving this in the future releases if feasible or this module could be removed in the future releases.</p>
                </div>
            </div>
            <div id="cleanEverything" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><span class="font-weight-bold text-danger"> <i class="icon-exclamation mr-2"></i> This is an irreversible action.</span></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-lg-12 col-form-label">Type <b>CONFIRM</b> to proceed.</label>
                                <div class="col-lg-12">
                                    <input type="text" name="clear_confirmation" class="form-control form-control-lg">
                                </div>
                            </div>
                            <i class="icon-spinner10 spinner text-warning ml-2 float-right hidden" id="cleanSpinner" style="font-size: 2.5rem;"></i>
                            <button type="button" class="btn btn-lg btn-danger float-right btn-labeled btn-labeled-left" disabled="disabled" id="cleanEverythingButton">
                            <b><i class="icon-arrow-right8"></i></b>
                            Proceed
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}" id="csrf">
            <div class="text-right mt-5">
                <button type="submit" class="btn btn-primary btn-labeled btn-labeled-left btn-lg">
                <b><i class="icon-database-insert ml-1"></i></b>
                Save Settings
                </button>
            </div>
            <input type="hidden" name="window_redirect_hash" value="">
            </form>
            </div>
            </div>
            </div>
            </div>
            @if($versionMsg != null)
            <div class="text-center mx-3" style="color: #9575cd;font-size: 0.8rem">{{ $versionMsg }}</div>
            @endif
<script>
    $(function() {
       $(".tips").select2({
           tags: true,
           tokenSeparators: [',',' '],
       })
       $(".tips").on("select2:select", function (evt) {
         var element = evt.params.data.element;
         var $element = $(element);
         $element.detach();
         $(this).append($element);
         $(this).trigger("change");
       })
       $(".tips_percentage").select2({
           tags: true,
           tokenSeparators: [',',' '],
       })
       $(".tips_percentage").on("select2:select", function (evt) {
         var element = evt.params.data.element;
         var $element = $(element);
         $element.detach();
         $(this).append($element);
         $(this).trigger("change");
       })
       $(document).on('keypress', '.tipss .select2-search__field', function () {
           $(this).val($(this).val().replace(/[^\d].+/, ""));
           if ((event.which < 48 || event.which > 57)) {
               event.preventDefault();
           }
       });

        $('.select').select2();
    
        function setSwitchery(switchElement, checkedBool) {
            if((checkedBool && !switchElement.isChecked()) || (!checkedBool && switchElement.isChecked())) {
                switchElement.setPosition(true);
                switchElement.handleOnchange(true);
            }
        }
    
        $('.form-control-uniform').uniform();
    
        // Display color formats
        $(".colorpicker-show-input").spectrum({
          showInput: true
        });
    
        if (Array.prototype.forEach) {
               var elems = Array.prototype.slice.call(document.querySelectorAll('.switchery-primary'));
               elems.forEach(function(html) {
                   var switchery = new Switchery(html, { color: '#2196F3' });
               });
           }
           else {
               var elems = document.querySelectorAll('.switchery-primary');
               for (var i = 0; i < elems.length; i++) {
                   var switchery = new Switchery(elems[i], { color: '#2196F3' });
               }
           }
    
        $('.summernote-editor').summernote({
               height: 200,
               popover: {
                   image: [],
                   link: [],
                   air: []
                 }
        });
    
        var css_editor = ace.edit("css_editor1");
        css_editor.setTheme("ace/theme/textmate");
        css_editor.getSession().setMode("ace/mode/css");
        css_editor.setShowPrintMargin(false);
    
        var customCSS1 = $('textarea[name="customCSS"]');
        css_editor.getSession().on("change", function () {
            customCSS1.val(css_editor.getSession().getValue());
        });
    
        
        $('.payment-gateway-switch').click(function(event) {
            var paymentgateway_id = $(this).val();
            var token = $("#csrf").val();
            console.log(paymentgateway_id);
    
            $.ajax({
                url: '{{ route('admin.togglePaymentGateways') }}',
                type: 'POST',
                dataType: 'json',
                data: {id: paymentgateway_id, _token: token},
            })
            .done(function() {
                $.jGrowl("Payment Gateway Updated", {
                    position: 'bottom-center',
                    header: 'SUCCESS 👌',
                    theme: 'bg-success',
                });
            })
            .fail(function() {
                $.jGrowl("Something went wrong! (Atleast one gateway needs to be active)", {
                    position: 'bottom-center',
                    header: 'Wooopsss ⚠️',
                    theme: 'bg-warning',
                });
                $('#paymentGatewaysData :input[value="'+ paymentgateway_id +'"]');
            })
        });
    
        $('.threshold-time').numeric({allowThouSep:false, allowDecSep:false, allowMinus: false, maxDigits: 3});
        $('.min-payout').numeric({allowThouSep:false, allowDecSep:true, allowMinus: false, maxDigits: 20});
        /* Navigate with hash */
        var hash = window.location.hash;
        $("[name='window_redirect_hash']").val(hash);
        hash && $('ul.nav a[href="' + hash + '"]').tab('show');
        $('.nav-pills a').click(function (e) {
            $(this).tab('show');
            var scrollmem = $('body').scrollTop();
            window.location.hash = this.hash;
            $("[name='window_redirect_hash']").val(this.hash);
            $('html, body').scrollTop(scrollmem);
        });
        
        $(".timezone-select").val("{{ config('app.timezone') }}").change();
    
        $('#forceClearCache, #forceClearSettings').dblclick(function(event) {
            event.preventDefault();
            let type = $(this).attr("data-type")
            let csrf = $('#csrf').val();
    
            $('#forceClearCache').addClass('disable-switch');
            $('#forceClearSettings').addClass('disable-switch');
            // $('#forceLogoutAllCustomers').addClass('disable-switch');
    
            $.ajax({
                url: '{{ route('admin.forceClear') }}',
                type: 'POST',
                dataType: 'JSON',
                data: {type: type, _token: csrf},
            })
            .done(function(data) {
                $('#cacheVersion').html(data.newVersion.forceCacheClearVersion.match(/.{1,5}/g).join("-"))
                $('#settingsVersion').html(data.newVersion.forceNewSettingsVersion.match(/.{1,5}/g).join("-"))
                // $('#logoutVersion').html(data.newVersion.forceLogoutAllCustomers.match(/.{1,5}/g).join("-"))
                
                $('#forceClearCache').removeClass('disable-switch');
                $('#forceClearSettings').removeClass('disable-switch');
                // $('#forceLogoutAllCustomers').removeClass('disable-switch');
    
                $.jGrowl("Operation Successful ✅", {
                    position: 'bottom-center',
                    header: '',
                    theme: 'bg-success',
                    life: '2000'
                }); 
            })
            .fail(function(data) {
                console.log("error");
                $('#forceClearCache').removeClass('disable-switch');
                $('#forceClearSettings').removeClass('disable-switch');
    
                $.jGrowl("Something went wrong! Please try again later.", {
                    position: 'bottom-center',
                    header: 'Wooopsss ⚠️',
                    theme: 'bg-warning',
                });
            })
        });
        
        /* Playing audio notification  when selected */
        $("#restaurantNotificationTone").change(function(event) {
            //create new audio
            let selectedFile = $(this).val();
            let notification = document.createElement('audio');
               notification.setAttribute('src', '{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/tones/'+selectedFile+'.mp3');
               notification.setAttribute('type', 'audio/mp3');
               notification.play();
        });
    
        // hide show selected sms gateway settings:
        $("[name='defaultSmsGateway']").change(function() {
            let selectedSmsGateway = $(this).val();
            if (selectedSmsGateway == 1) {
                $('#msg91Settings').removeClass('hidden');
                $('#twilioSettings').addClass('hidden');
            } 
            if (selectedSmsGateway == 2) {
                $('#twilioSettings').removeClass('hidden');
                $('#msg91Settings').addClass('hidden');
            } 
        });
    
        $("[name='clear_confirmation']").on("keyup", function() {
         $("#cleanEverythingButton").attr("disabled", true);
          if( $("[name='clear_confirmation']").val() == 'CONFIRM') {
             $("#cleanEverythingButton").attr("disabled", false);
         }
        });
        $('#cleanEverythingButton').click(function(event) {
            event.preventDefault();
            let cleanEverythingButton = $(this);
            cleanEverythingButton.addClass('hidden');
            $('#cleanSpinner').removeClass('hidden');
            $.ajax({
                url: "{{ route('admin.cleanEverything') }}",
                type: 'POST',
                dataType: 'JSON',
                data: {_token: $('#csrf').val()},
            })
            .done(function(data) {
                console.log("success", data);
                $.jGrowl("All the databases has been cleaned", {
                    position: 'bottom-center',
                    header: 'Operation Successful ✅',
                    theme: 'bg-success',
                    life: '2000'
                }); 
                $('#cleanEverything').modal('hide');
                setTimeout(function() {
                    window.location.reload();
                }, 1000);
            })
            .fail(function(data) {
                console.log(data)
                $.jGrowl("Something went wrong! Please try again later.", {
                    position: 'bottom-center',
                    header: 'Wooopsss ⚠️',
                    theme: 'bg-warning',
                });
                cleanEverythingButton.removeClass('hidden');
                $('#cleanSpinner').addClass('hidden');
            })
        });
    
        $('.backupBtn').click(function(event) {
            $(this).attr('disabled', true);
            $(this).html('<b><i class="icon-spinner10 spinner position-left"></i></b>Please Wait...')
        });
    
        $("[name='defaultEmailGateway']").change(function() {
            let selectedEmailGateway = $(this).val();
            if (selectedEmailGateway == "sendgrid") {
                $('#sendgridSettings').removeClass('hidden');
                $('#smtpSettings').addClass('hidden');
            } 
            if (selectedEmailGateway == "smtp") {
                $('#smtpSettings').removeClass('hidden');
                $('#sendgridSettings').addClass('hidden');
                //open customSMTPDisclaimer modal
                $('#customSMTPDisclaimer').modal({
                           backdrop: 'static',
                           keyboard: false
                       });
            } 
        });
    
        $('#fixUpdateIssuesButton').click(function(event) {
            $(this).addClass("popup-order-processing").html("Please Wait... Do not hit back or refresh the page.")
        });
    });
</script>
@endsection