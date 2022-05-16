<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="blog-main-wrapper section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="blog-item-wrapper">
                    <div class="blog-post-item blog-details-post">
                        <figure class="blog-thumb">
                            <div class="blog-carousel-2 slick-row-15 slick-arrow-style slick-dot-style">
                                <div class="blog-single-slide">
                                    <?= img('admin/image/blog/'.$data['image'], '', 'height="500"') ?>
                                </div>
                                <?php foreach($this->main->getall('blog_imgs', 'p_image', ['b_id' => $data['id']]) as $img): ?>
                                <div class="blog-single-slide">
                                    <?= img('admin/image/blog/'.$img->p_image, '', 'height="500"') ?>
                                </div>
                                <?php endforeach ?>
                            </div>
                        </figure>
                        <div class="blog-content">
                            <h3 class="blog-title">
                                <?= $data['title'] ?>
                            </h3>
                            <div class="blog-meta">
                                <?= APP_NAME ?>
                            </div>
                            <div class="entry-summary">
                                <?= $data['detail'] ?>
                                <div class="tag-line">
                                    <div class="blog-share-link">
                                        <h6>Share :</h6>
                                        <div class="blog-social-icon">
                                            <a href="https://www.facebook.com/sharer.php?u=<?= current_url() ?>" class="facebook" target="_blank"><i class="fa fa-facebook"></i></a>
                                            <a href="https://twitter.com/share?url=<?= current_url() ?>&text=<?= APP_NAME ?>&hashtags=<?= APP_NAME ?>" class="twitter" target="_blank"><i class="fa fa-twitter"></i></a>
                                            <a href="https://api.whatsapp.com/send?text=<?= APP_NAME ?> <?= current_url() ?>" class="whatsapp" target="_blank"><i class="fa fa-whatsapp"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if($comments): ?>
                <div class="comment-section section-padding">
                    <h5><?= count($comments) ?> Comment</h5>
                    <ul>
                        <?php foreach($comments as $comment): ?>
                            <li>
                                <div class="author-avatar">
                                    <?= img('admin/image/logo.png') ?>
                                </div>
                                <div class="comment-body">
                                    <h5 class="comment-author"><?= $comment->name ?></h5>
                                    <div class="comment-post-date">
                                        <?= date('d M, Y', $comment->created_at) ?> at <?= date('h:i A', $comment->created_at) ?>
                                    </div>
                                    <p><?= $comment->comment ?></p>
                                </div>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
                <?php endif ?>
                <div class="blog-comment-wrapper mt-4">
                    <h5>Leave a reply</h5>
                    <p>Your email address will not be published. Required fields are marked *</p>
                    <?= form_open('', 'id="comment-form"') ?>
                        <div class="comment-post-box">
                            <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" name="name" maxlength="100" class="coment-field" placeholder="Name" required />
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" maxlength="100" class="coment-field" placeholder="Email" required />
                                </div>
                                <div class="col-12">
                                    <label for="comment">Comment</label>
                                    <textarea name="comment" id="comment" name="comment" maxlength="255" placeholder="Write a comment" required></textarea>
                                </div>
                                <div class="col-12">
                                    <div class="coment-btn">
                                        <input class="btn btn-sqr" type="submit" value="Post Comment" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>