<div class="row mb-4">
                    <div class="col-lg-12">
                        <div class="ib-action-bar card">
                            <div class="card-body py-2">
                                <div class="d-flex align-items-center">

                                            <?php if($has_add && canEdit($page['isSystemOperated'])): ?>
                                            <a class="btn btn-sm btn-outline-secondary mr-2 duplicate-page" href="#" data-pageid="<?=$page['pid']?>">
                                                <i class="fas fa-copy fa-fw"></i> Duplicate this page
                                            </a>
                                            <?php endif; ?>

                                            <?php if($has_status && canActivate($page['isSystemOperated'])): ?>
                                            <div class="dropdown d-inline-block mr-2">
                                                <button class="btn btn-sm btn-outline-<?=$page['isactive'] ? 'success' : 'warning'?> dropdown-toggle"
                                                        type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-power-off fa-fw"></i> <?=$page['isactive'] ? 'Active' : 'Inactive'?>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#" onclick="toggleStatus(<?=$page['pid']?>, <?=$page['isactive']?>)">
                                                        <i class="fas fa-power-off fa-fw"></i> <?=$page['isactive'] ? 'Deactivate' : 'Activate'?>
                                                    </a>
                                                </div>
                                            </div>
                                            <?php endif; ?>

                                            <?php if($has_delete && canDelete($page['isSystemOperated'])): ?>
                                            <button class="btn btn-sm btn-outline-danger" onclick="delete_(<?=$page['pid']?>)">
                                                <i class="fas fa-trash fa-fw"></i> Move to Recycle Bin
                                            </button>
                                            <?php endif; ?>

                                            <button class="btn btn-sm btn-outline-warning ml-2" onclick="if (confirm('Are you sure you want to discard all unsaved changes?')) { location.reload(); }">
                                                <i class="fas fa-undo fa-fw"></i> Discard Changes
                                            </button>

                                            <div class="ml-auto">
                                                </div>
                                        </div>
                            </div>
                        </div>
                    </div>
                </div>