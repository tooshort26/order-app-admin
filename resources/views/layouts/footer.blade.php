    <!-- /.container-fluid -->
<footer class="footer text-center">{{ date('Y') }} - {{ date('Y', strtotime('+1 year')) }} | Mai Place Administrator</footer>
</div>
<!-- ============================================================== -->
<!-- End Page Content -->
<!-- ============================================================== -->
</div>
<!-- /#wrapper -->
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js" integrity="sha256-ImQvICV38LovIsvla2zykaCTdEh1Z801Y+DSop91wMU=" crossorigin="anonymous"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js" integrity="sha256-qE/6vdSYzQu9lgosKxhFplETvWvqAAlmAuR+yPh/0SI=" crossorigin="anonymous"></script>
    <!--Wave Effects -->
    <script src="/js/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="/js/custom.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js" integrity="sha256-56zsTlMwzGRtLC4t51alLh5cKYvi0hnbhEXQTVU/zZQ=" crossorigin=
    "anonymous"></script>
    <script src="https://unpkg.com/@feathersjs/client@^4.3.0/dist/feathers.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script>
    @stack('page-scripts')

<!-- end - This is for export functionality only -->
<script>
// Socket.io setup
const mSocket = io('http://192.168.1.4:3030');

// Init feathers app
const mApp = feathers();

// Register socket.io to talk to server
mApp.configure(feathers.socketio(mSocket));





function listeningToAnOrder() {
    mApp.service('orders').on('created', (order_no) => {
	        $.toast({
	                text: "Click this <a href='/admin/order'>link</a> to view all orders.", // Text that is to be shown in the toast
	                heading: `New Order # ${order_no}`, // Optional heading to be shown on the toast
	                icon: 'success', // Type of toast icon
	                showHideTransition: 'slide', // fade, slide or plain
	                allowToastClose: true, // Boolean value true or false
	                hideAfter: false, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
	                stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
	                position: 'bottom-right', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
	                
	                
	                
	                textAlign: 'left',  // Text alignment i.e. left, right or center
	                loader: true,  // Whether to show loader or not. True by default
	                loaderBg: '#9EC600',  // Background color of the toast loader
	         });
    });
}

listeningToAnOrder();


</script>
</body>

</html>
