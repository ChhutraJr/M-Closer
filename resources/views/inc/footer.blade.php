<div class="footer hidden-sm hidden-xs">
    <div class="container">
        <div class="footer-top-at">

            <div class="col-md-3 amet-sed">
                <h4>ព័ត៌មានបន្ថែម</h4>
                <ul class="nav-bottom ">
                    <li><a href="javascript:void(0)">របៀបទិញ</a></li>
                    <li><a href="javascript:void(0)">សំនួរចំលើយ</a></li>
                    <li><a href="javascript:void(0)">ទីតាំង</a></li>
                    <li><a href="javascript:void(0)">ដឹកជញ្ចូន</a></li>
                    <li><a href="javascript:void(0)">សមាជិក</a></li>
                </ul>
            </div>
            <div class="col-md-3 amet-sed">
                <h4>ប្រភេទ</h4>
                <ul class="nav-bottom">
                    @foreach($cat_footer as $cat_f)
                        <li><a href="{{url('category/'.$cat_f->slug)}}">{{$cat_f->name}}</a></li>
                    @endforeach

                </ul>

            </div>
            <div class="col-md-3 amet-sed ubuntu">
                <h4 >ព្រឹត្តិប័ត្រព័ត៌មាន</h4>
                <div class="stay">
                    <div class="stay-left">
                        <form>
                            <input type="text" placeholder="Enter your email " required="">
                        </form>
                    </div>
                    <div class="btn-1">
                        <form>
                            <input type="button" class="btn btn-success btn-yl" value="Subscribe">
                        </form>
                    </div>
                    <div class="clearfix"> </div>
                </div>

            </div>
            <div class="col-md-3 amet-sed ubuntu ">
                <h4>ទំនាក់ទំនង</h4>
                <p>Street 173
                    Phnom Penh 23</p>
                <p>Phone: 023 633 9999</p>
                <p>Email:<a href="mailto:contact@example.com"> lvfurniture168@gmail.com</a></p>


                    <a target="_blank" class="facebookBtn smGlobalBtn" href="https://www.facebook.com/LVFurniture168/" ></a>

            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    <div class="footer-class ubuntu">
        <p>© 2018 LV-Furniture . All Rights Reserved | Hosted By <a target="_blank" href="http://edgesightsolution.com" style="color:#dc4025">EdgeSight Solution</a></p>
    </div>
</div>

<script src="{{url('admin/assets/plugins/toastr/toastr.min.js')}}"></script>
</body>
</html>
