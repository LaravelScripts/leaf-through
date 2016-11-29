@extends('layouts.app')

@section('title', 'Dashboard')

@section('customjs')

@endsection

@section('content')
    <div class="leaf-through-content">
        <div class="card">
            <div class="options">
                <a href="#" class="post-options">
                    <span></span>
                    <span></span>
                    <span></span>
                </a>
                <ul class="hidden">
                    <li><a href="#share-link" data-toggle="modal">Share</a></li>
                    <li><a href="">Archive</a></li>
                    <li><a href="">Delete</a></li>
                </ul>
            </div>
            <div class="author">
                <div class="row">
                    <div class="col-sm-1">
                        <img src="http://0.gravatar.com/avatar/9ba6ee9118b952c96bf71c8d43dada35?size=60" alt="" class="profile-image">
                    </div>
                    <div class="col-sm-11">
                        <span class="name">Joshua Sarav</span>
                        <span class="description">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate velit
                        </span>
                        <span class="published-on">2 days ago</span>
                        <span class="read">{{ timeToRead("Hola") }}</span>
                    </div>
                </div>
            </div>
            <div class="content">
                <h1>FreeCodeCamp and the JavaScript Tattoo</h1>
                <p>“Wow! Your software business sounds amazing, Andrea. So, tell me…do you code, too?”</p>

                <p>Every time I’ve heard this question over the past six years, it’s grated on my confidence.</p>

                <p>Nevermind that I’ve built websites from scratch.</p>

                <p>Nevermind that I’ve developed a business around modernizing codebases.</p>

                <p>Nevermind that can confidently describe techniques like reducing cyclomatic complexity, refactoring duplication, using branches in source control, or Test Driven Development (TDD).</p>

                <p>To most people, I simply don’t “look like” a software developer. Hence, the dreaded question when people meet me: “So, do you code?”</p>

                <blockquote>
                    “The reward for work well done is the opportunity to do more.” —Dr. Jonas Salk
                </blockquote>

                <h2>Usage</h2>

                <p>Via data attributes or JavaScript, the dropdown plugin toggles hidden content (dropdown menus) by toggling the .open class on the parent list item.</p>

                <p>On mobile devices, opening a dropdown adds a .dropdown-backdrop as a tap area for closing dropdown menus when tapping outside the menu, a requirement for proper iOS support. This means that switching from an open dropdown menu to a different dropdown menu requires an extra tap on mobile.</p>

                <p>Note: The data-toggle="dropdown" attribute is relied on for closing dropdown menus at an application level, so it's a good idea to always use it.</p>


                <h3>@fat</h3>

                <p>Ad leggings keytar, brunch id art party dolor labore. Pitchfork yr enim lo-fi before they sold out qui. Tumblr farm-to-table bicycle rights whatever. Anim keffiyeh carles cardigan. Velit seitan mcsweeney's photo booth 3 wolf moon irure. Cosby sweater lomo jean shorts, williamsburg hoodie minim qui you probably haven't heard of them et cardigan trust fund culpa biodiesel wes anderson aesthetic. Nihil tattooed accusamus, cred irony biodiesel keffiyeh artisan ullamco consequat.</p>

                <h3>@mdo</h3>

                <p>Veniam marfa mustache skateboard, adipisicing fugiat velit pitchfork beard. Freegan beard aliqua cupidatat mcsweeney's vero. Cupidatat four loko nisi, ea helvetica nulla carles. Tattooed cosby sweater food truck, mcsweeney's quis non freegan vinyl. Lo-fi wes anderson +1 sartorial. Carles non aesthetic exercitation quis gentrify. Brooklyn adipisicing craft beer vice keytar deserunt.</p>

                <strong>One</strong>

                <p>Occaecat commodo aliqua delectus. Fap craft beer deserunt skateboard ea. Lomo bicycle rights adipisicing banh mi, velit ea sunt next level locavore single-origin coffee in magna veniam. High life id vinyl, echo park consequat quis aliquip banh mi pitchfork. Vero VHS est adipisicing. Consectetur nisi DIY minim messenger bag. Cred ex in, sustainable delectus consectetur fanny pack iphone.</p>

                <strong>Two</strong>

                <p>In incididunt echo park, officia deserunt mcsweeney's proident master cleanse thundercats sapiente veniam. Excepteur VHS elit, proident shoreditch +1 biodiesel laborum craft beer. Single-origin coffee wayfarers irure four loko, cupidatat terry richardson master cleanse. Assumenda you probably haven't heard of them art party fanny pack, tattooed nulla cardigan tempor ad. Proident wolf nesciunt sartorial keffiyeh eu banh mi sustainable. Elit wolf voluptate, lo-fi ea portland before they sold out four loko. Locavore enim nostrud mlkshk brooklyn nesciunt.</p>

                <strong>Three</strong>

                <p>Ad leggings keytar, brunch id art party dolor labore. Pitchfork yr enim lo-fi before they sold out qui. Tumblr farm-to-table bicycle rights whatever. Anim keffiyeh carles cardigan. Velit seitan mcsweeney's photo booth 3 wolf moon irure. Cosby sweater lomo jean shorts, williamsburg hoodie minim qui you probably haven't heard of them et cardigan trust fund culpa biodiesel wes anderson aesthetic. Nihil tattooed accusamus, cred irony biodiesel keffiyeh artisan ullamco consequat.</p>

                <p>Keytar twee blog, culpa messenger bag marfa whatever delectus food truck. Sapiente synth id assumenda. Locavore sed helvetica cliche irony, thundercats you probably haven't heard of them consequat hoodie gluten-free lo-fi fap aliquip. Labore elit placeat before they sold out, terry richardson proident brunch nesciunt quis cosby sweater pariatur keffiyeh ut helvetica artisan. Cardigan craft beer seitan readymade velit. VHS chambray laboris tempor veniam. Anim mollit minim commodo ullamco thundercats.</p>

            </div>
            <div class="modal" id="share-link" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Share Link</h4>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label for="to">To Address<em>*</em></label>
                                    <input type="text" name="to" v-model = "to" id="to" class="form-control"  placeholder="Enter the email address">
                                </div>
                                <div class="form-group">
                                    <label for="message">Message (optional)</label>
                                    <textarea name="message" v-model = "message" cols="30" rows="3" class="form-control"  placeholder="Enter the message"></textarea>
                                </div>
                                <div class="form-group checkbox">
                                    <input type="checkbox" name="slack_notification" v-model = "slack_notification" id = "slack_notification">
                                    <label for="slack_notification">Send Slack Notification</label>
                                </div>
                                <div class="form-group checkbox">
                                    <input type="checkbox" name="send_annotation" v-model = "send_annotation" id="send_annotation">
                                    <label for="send_annotation">Send with Annotation</label>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" v-on:click = "share">
                                        Share Link
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>
    </div>
@endsection
