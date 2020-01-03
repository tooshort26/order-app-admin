@extends('layouts.master')
@section('title', 'Dashboard')
@section('sub-title', '')
@prepend('page-css')
    
    <!-- chartist CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chartist/0.11.4/chartist.min.css" integrity="sha256-seGyqLj5T52Hx8W7/YTajtNXGXQf+IksfkcaKGoTkbY=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chartist-plugin-tooltips@0.0.17/dist/chartist-plugin-tooltip.css">
    <!-- animation CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css" integrity="sha256-1hIhSlowg4vqaFZ/bikPMfEGwSgM0FtIs7mx1PADHCk=" crossorigin="anonymous" />
    <!-- morris CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <!--Gauge chart CSS -->
    <link href="/plugins/bower_components/Minimal-Gauge-chart/css/cmGauge.css" rel="stylesheet" type="text/css" />
@endprepend
@section('dashboard-content')
                <!-- ============================================================== -->
                <!-- Sales different chart widgets -->
                <!-- ============================================================== -->
                <!-- .row -->
                <div class="row">
                    <div class="col-md-12 col-lg-4">
                        <div class="white-box">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h2 class="m-b-0 font-medium">$354.50</h2>
                                    <h5 class="text-muted m-t-0">Total Income</h5></div>
                                <div class="col-sm-6">
                                    <div id="ct-bar-chart" class="pull-right"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4">
                        <div class="white-box">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h2 class="m-b-0 font-medium">4567</h2>
                                    <h5 class="text-muted m-t-0">Yearly Sales</h5></div>
                                <div class="col-sm-6">
                                    <div id="ct-main-bal" style="height: 70px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4">
                        <div class="white-box">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h2 class="m-b-0 font-medium">356</h2>
                                    <h5 class="text-muted m-t-0">Monthly Sales</h5></div>
                                <div class="col-sm-6">
                                    <div id="ct-extra" style="height: 70px" class="pull-right"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <!-- ============================================================== -->
                <!-- Sales, finance & Expance widgets -->
                <!-- ============================================================== -->
                <!-- .row -->
                <div class="row">
                    <div class="col-md-7 col-sm-12 col-lg-8">
                        <div class="white-box b-b bg-extralight m-b-0">
                            <h3 class="box-title">Expence</h3>
                            <div class="demo-container" style="height:140px;">
                                <div id="placeholder" class="demo-placeholder"></div>
                            </div>
                        </div>
                        <div class="white-box p-b-0">
                            <div class="row">
                                <div class="col-xs-8">
                                    <h2 class="font-medium m-t-0">$458.50</h2>
                                    <h5 class="text-muted m-t-0">Expence for December 1 to 10</h5>
                                </div>
                                <div class="col-xs-4">
                                    <div class="circle-md pull-right circle bg-info"><i class="ti-plus"></i></div>
                                </div>
                            </div>
                            <div class="row m-t-30 minus-margin">
                                <div class="col-sm-12 col-sm-6 b-t b-r">
                                    <ul class="expense-box">
                                        <li><i class="ti-headphone-alt text-info"></i>
                                            <div>
                                                <h2>$250</h2>
                                                <h4>Entertainment</h4>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-sm-12 col-sm-6  b-t">
                                    <ul class="expense-box">
                                        <li><i class="ti-home text-info"></i>
                                            <div>
                                                <h2>$60.50</h2>
                                                <h4>House Rent</h4>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row minus-margin">
                                <div class="col-sm-12 col-sm-6  b-t b-r">
                                    <ul class="expense-box">
                                        <li><i class="fa fa-paper-plane-o text-info"></i>
                                            <div>
                                                <h2>$28</h2>
                                                <h4>Travel</h4>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-sm-12 col-sm-6  b-t">
                                    <ul class="expense-box">
                                        <li><i class="ti-shopping-cart text-info"></i>
                                            <div>
                                                <h2>$70</h2>
                                                <h4>Shopping</h4>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- col-md-3 -->
                    <div class="col-md-5 col-sm-12 col-lg-4">
                        <div class="white-box">
                            <h3 class="box-title">Sales</h3>
                            <div id="morris-donut-chart" style="height:318px; padding-top: 50px;"></div>
                            <div class="row p-t-30">
                                <div class="col-xs-8 p-t-30">
                                    <h3 class="font-medium">TOTAL SALES</h3>
                                    <h5 class="text-muted m-t-0">160 sales monthly</h5>
                                </div>
                                <div class="col-xs-4 p-t-30">
                                    <div class="circle-md pull-right circle bg-info"><i class="ti-shopping-cart"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <!-- col-md-3 -->
                    <div class="col-md-12 col-lg-5">
                        <div class="white-box">
                            <h3 class="box-title">Finance</h3>
                            <div id="diagram"></div>
                            <div class="get">
                                <div class="arc"> <span class="text">Aug</span>
                                    <input type="hidden" class="percent" value="95" />
                                    <input type="hidden" class="color" value="#7ace4c" /> </div>
                                <div class="arc"> <span class="text">Sep</span>
                                    <input type="hidden" class="percent" value="90" />
                                    <input type="hidden" class="color" value="#f33155" /> </div>
                                <div class="arc"> <span class="text">Oct</span>
                                    <input type="hidden" class="percent" value="80" />
                                    <input type="hidden" class="color" value="#11a0f8" /> </div>
                                <div class="arc"> <span class="text">Nov</span>
                                    <input type="hidden" class="percent" value="53" />
                                    <input type="hidden" class="color" value="#cfecfe" /> </div>
                                <div class="arc"> <span class="text">Dec</span>
                                    <input type="hidden" class="percent" value="45" />
                                    <input type="hidden" class="color" value="#EDEBEE" /> </div>
                            </div>
                            <div class="row p-t-30">
                                <div class="col-xs-8">
                                    <h1 class="font-medium m-t-0">56%</h1>
                                    <h5 class="text-muted m-t-0">increase in Nov</h5>
                                </div>
                                <div class="col-xs-4">
                                    <div class="circle-md pull-right circle bg-success"><i class="ti-stats-up"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- col-md-3 -->
                    <div class="col-md-12 col-lg-7 col-sm-12">
                        <div class="calendar-widget m-b-30">
                            <div class="cal-left">
                                <h1>23</h1>
                                <h4>Thursday</h4> <span></span>
                                <h5>March 2017</h5>
                                <div class="cal-btm-text"> <a href="">3 TASKS</a>
                                    <h5>Prepare project</h5>
                                </div>
                            </div>
                            <div class="cal-right bg-extralight">
                                <table class="cal-table">
                                    <tbody>
                                        <tr>
                                            <td colspan="5">
                                                <h1>March</h1>
                                            </td>
                                            <td></td>
                                            <td><a href="" class="cal-add"><i class="ti-plus"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>SUN</td>
                                            <td>MON</td>
                                            <td>TUE</td>
                                            <td>WED</td>
                                            <td>THU</td>
                                            <td>FRI</td>
                                            <td>SAT</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>1</td>
                                            <td>2</td>
                                            <td>3</td>
                                            <td>4</td>
                                            <td>5</td>
                                            <td>6</td>
                                        </tr>
                                        <tr>
                                            <td>7</td>
                                            <td>8</td>
                                            <td>9</td>
                                            <td>10</td>
                                            <td>11</td>
                                            <td>12</td>
                                            <td>13</td>
                                        </tr>
                                        <tr>
                                            <td>14</td>
                                            <td>15</td>
                                            <td>16</td>
                                            <td>17</td>
                                            <td>18</td>
                                            <td>19</td>
                                            <td>20</td>
                                        </tr>
                                        <tr>
                                            <td>21</td>
                                            <td>22</td>
                                            <td class="cal-active">23</td>
                                            <td>24</td>
                                            <td>25</td>
                                            <td>26</td>
                                            <td>27</td>
                                        </tr>
                                        <tr>
                                            <td>28</td>
                                            <td>29</td>
                                            <td>30</td>
                                            <td>31</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="7"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
@push('page-scripts')
    <!--Morris JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <!-- Flot Charts JavaScript -->
    <script src="/plugins/bower_components/flot/jquery.flot.js"></script>
    <script src="/plugins/bower_components/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <!-- Animated skill bar -->
    <script src="/plugins/bower_components/AnimatedSkillsDiagram/js/animated-bar.js"></script>
    <!-- chartist chart -->
    {{-- <script src="/plugins/bower_components/chartist-js/dist/chartist.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartist/0.11.4/chartist.min.js" integrity="sha256-xNhpuwaNiVdna6L8Wy3GNuQz1z+SCmo4NY1c7cJ9Vdc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartist-plugin-tooltips@0.0.17/dist/chartist-plugin-tooltip.min.js"></script>
    <!-- Guage chart -->
    <script src="/plugins/bower_components/Minimal-Gauge-chart/js/cmGauge.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="/js/dashboard2.js"></script>
@endpush
@endsection