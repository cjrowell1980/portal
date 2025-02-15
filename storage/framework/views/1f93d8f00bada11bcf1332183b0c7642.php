<?php $__env->startSection('content'); ?>

<div class="row justify-content-center">
    <div>

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Job Information
                </div>
                <div class="float-end">
                    <form action="<?php echo e(route('jobs.destroy', $job->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <a href="<?php echo e(route('machines.show', $job->getMachine->id)); ?>" class="btn btn-primary btn-sm">&larr; Back</a>
                        <?php if($job->status == 1): ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit-jobs')): ?>
                                <a href="<?php echo e(route('jobs.edit', $job->id)); ?>" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i> Edit</a>                                
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete-jobs')): ?>
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Do you want to delete this job?');"><i class="bi bi-trash"></i> Delete
                            <?php endif; ?>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
            <div class="card-body">

                    <div class="row">
                        <label for="number" class="col-md-4 col-form-label text-md-end text-start"><strong>Job Number:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            <?php echo e($job->number); ?>

                        </div>
                    </div>

                    <div class="row">
                        <label for="status" class="col-md-4 col-form-label text-md-end text-start"><strong>Status:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">    
                            <?php if($job->status): ?>
                                <span class="badge rounded-pill bg-warning w-25">Open</span>    
                            <?php else: ?>
                                <span class="badge rounded-pill bg-success 2-25">Closed</span>                            
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="row">
                        <label for="machine" class="col-md-4 col-form-label text-md-end text-start"><strong>Machine:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            <?php echo e($job->getMachine->stock . " - " . $job->getMachine->make . " " . $job->getMachine->model); ?>

                        </div>
                    </div>

                    <div class="row">
                        <label for="fault" class="col-md-4 col-form-label text-md-end text-start"><strong>Reported Fault:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            <?php echo e($job->fault); ?>

                        </div>
                    </div>

                    <div class="row">
                        <label for="fault" class="col-md-4 col-form-label text-md-end text-start"><strong>Date Reported:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            <?php echo e($job->created_at->format('d M Y')); ?>

                        </div>
                    </div>

                    <div class="row">
                        <label for="fault" class="col-md-4 col-form-label text-md-end text-start"><strong><?php echo e(($job->status == 0) ? "Date Closed" : "Days Open"); ?>:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            <?php echo e(($job->status == 0) ? $job->updated_at->format('d M Y') . " (" . $job->updated_at->diffInDays($job->created_at) . "days)" : now()->diffInDays($job->created_at)); ?>

                        </div>
                    </div>

                    <div class="row">
                        <label for="status" class="col-md-4 col-form-label text-md-end text-start"><strong>Statuses:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            
                            <span class="badge rounded-pill bg-<?php echo e($job->getStatus1->colour); ?> w-23">Jobsheet <?php echo e($job->getStatus1->name); ?></span>
                            
                            <span class="badge rounded-pill bg-<?php echo e($job->getStatus3->colour); ?> w-23">Photos <?php echo e($job->getStatus3->name); ?></span>
                            
                            <span class="badge rounded-pill bg-<?php echo e($job->getStatus2->colour); ?> w-23">Invoice In <?php echo e($job->getStatus2->name); ?></span>
                            
                            <span class="badge rounded-pill bg-<?php echo e($job->getStatus4->colour); ?> w-23">Invoice Out <?php echo e($job->getStatus4->name); ?></span>
                        </div>
                    </div>

            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <div class="float-start">
                    Visits
                </div>
                <div class="float-end">
                    <!--<a href="#" class="btn btn-sm btn-success">Add </a>-->
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <th scope="col" width="1%">#</th>
                        <th scope="col" width="100px">Opened</th>
                        <th scope="col" width="100px">Scheduled</th>
                        <th scope="col">Report</th>
                        <th scope="col" width="100px" class="text-center">Outcome</th>
                        <th scope="col" width="100p" class="text-center">Status</th>
                        <th scope="col" width="150px" class="text-center">Action</th>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $visits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($row->created_at->format('d M Y')); ?></td>
                                <td>
                                    <?php if(empty(!$row->scheduled)): ?>
                                        <?php echo e(date('d M Y', strtotime($row->scheduled))); ?>

                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($row->report); ?></td>
                                <td class="text-center">
                                    <?php switch($row->outcome):
                                        case (1): ?>
                                            <span class="badge rounded-pill bg-primary w-100">Scheduled</span>
                                            <?php break; ?>
                                        <?php case (2): ?>
                                            <span class="badge rounded-pill bg-warning w-100">Revisit Req</span>
                                            <?php break; ?>
                                        <?php case (3): ?>
                                            <span class="badge rounded-pill bg-success w-100">Complete</span>
                                            <?php break; ?>
                                        <?php default: ?>
                                            <span class="badge rounded-pill bg-info w-100">Pending</span> 
                                    <?php endswitch; ?>
                                </td>
                                <td class="text-center">
                                    <?php if($row->status): ?>
                                        <span class="badge rounded-pill bg-warning w-100">Open</span>
                                    <?php else: ?>
                                        <span class="badge rounded-pill bg-success w-100">Closed</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>
                                    <?php if($row->status): ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit-jobs')): ?>
                                            <a href="#" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i> Edit</a>                                                
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <td colspan="6">
                            <span class="text-danger text-center fw-bold">
                                <p>No Visits Found!</p>
                            </span>
                        </td>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\cjrow\OneDrive\Desktop\VSC_Projects\Portal\resources\views/jobs/show.blade.php ENDPATH**/ ?>