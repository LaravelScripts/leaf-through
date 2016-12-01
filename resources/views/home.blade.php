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
                <ul class="hidden" id = "article-actions">
                    <li><a href="#share-link" data-toggle="modal">Share</a></li>
                    <li><a href="">Archive</a></li>
                    <li><a v-on:click = "deleteArticle">Delete</a></li>
                </ul>
            </div>
            <div class="author">
                <div class="row">
                    <div class="col-sm-1">
                        <img src="http://0.gravatar.com/avatar/9ba6ee9118b952c96bf71c8d43dada35?size=60" alt="" class="profile-image">
                    </div>
                    <div class="col-sm-11">
                        <span class="name">{{ $article->author or "Unavailable" }}</span>
                        <span class="description">
                            {{ $article->title }}
                        </span>
                        <span class="published-on">{{ $article->published_at or "unavailable" }}</span>
                        <span class="read">{{ timeToRead($article->content) }}</span>
                    </div>
                </div>
            </div>
            <div class="content">
                {!! html_entity_decode($article->content) !!} <?php //Prone to XSS attack ?>
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
