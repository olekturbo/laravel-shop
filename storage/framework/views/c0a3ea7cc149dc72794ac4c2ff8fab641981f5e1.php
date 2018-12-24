<?php $__env->startSection('content'); ?>
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="#"><?php echo e($product->category->name); ?></a></li>
            <li><?php echo e($product->name); ?></li>
        </ul>
        <form method="POST" action="<?php echo e(route('product.addToCart', $product->id)); ?>">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="slider-pro" id="product-slider">
                        <div class="sp-slides">
                            <?php $__currentLoopData = $product->decoded_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $decoded_image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="sp-slide">
                                <img class="sp-image" src="<?php echo e(Voyager::image($decoded_image)); ?>" data-src="<?php echo e(Voyager::image($decoded_image)); ?>" data-retina="<?php echo e(Voyager::image($decoded_image)); ?>">
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <div class="sp-thumbnails">
                            <?php $__currentLoopData = $product->decoded_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $decoded_image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <img class="sp-thumbnail" src="<?php echo e(Voyager::image($decoded_image)); ?>" data-src="<?php echo e(Voyager::image($decoded_image)); ?>" data-retina="<?php echo e(Voyager::image($decoded_image)); ?>"/>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 pl-5">
                    <h1>SUPERSTAR 2000</h1>
                    <div class="product-info pt-1">
                        <?php if($product->quantity > 0): ?> <span class="badge badge-success p-2">DOSTĘPNY</span> <?php endif; ?>
                        <?php if($product->is_new): ?> <span class="badge badge-warning p-2 text-white">NOWOŚĆ</span> <?php endif; ?>
                        <?php if($product->is_discount): ?> <span class="badge badge-danger p-2">PROMOCJA</span> <?php endif; ?>
                    </div>
                    <h3 class="pt-3"><i class="fas fa-dollar-sign"></i> <?php echo e($product->price); ?> PLN <?php if($product->discount_price): ?> <del style="color: #dc3545"><?php echo e($product->discount_price); ?>PLN</del> <?php endif; ?></h3>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="product-size">
                                <h5>ROZMIAR</h5>
                                <?php $__currentLoopData = $product->decoded_sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $decoded_size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="icheck-success icheck-inline">
                                    <input type="radio" id="r<?php echo e($loop->index); ?>" name="size" value="<?php echo e($decoded_size); ?>" />
                                    <label for="r<?php echo e($loop->index); ?>"><?php echo e($decoded_size); ?></label>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5>ILOŚĆ</h5>
                            <input name="quantity" class="w-50" type="number" min="1" max="<?php echo e($product->quantity); ?>" step="1" value="1">
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <button id="checkBtn" type="submit" class="btn btn-template btn-lg"><i class="fas fa-shopping-cart"></i> Dodaj do koszyka</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="row mt-3">
            <div class="col-md-12">
                <h1>OPIS</h1>
                <?php echo $product->description; ?>

            </div>
        </div>
        <?php if($similar_products->count()): ?>
        <div class="row mt-3">
            <div class="col-md-12">
                <h1>PRODUKTY PODOBNE</h1>
              <div class="row">
                  <?php $__currentLoopData = $similar_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $similar_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 <a href="<?php echo e(route('product', [$similar_product->id, str_slug($similar_product->name)])); ?>">
                     <div class="col-md-3">
                         <img class="w-100" src="<?php echo e(Voyager::image($similar_product->front_image)); ?>">
                         <p class="text-center text-uppercase"><?php echo e($similar_product->name); ?></p>
                     </div>
                 </a>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        $(document).ready(function () {
            $('#checkBtn').click(function() {
                checked = $("input[type=radio]:checked").length;

                if(!checked) {
                    alert("Musisz zaznaczyć rozmiar!");
                    return false;
                }

            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>