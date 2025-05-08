<!-- Basic SEO Card -->
<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Basic SEO Settings</h5>
    </div>
    <div class="card-body">
        <div class="form-group row">
            <label for="meta_title" class="col-sm-2 col-form-label">Meta Title</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="meta_title" placeholder="Page title (50-60 characters)" name="meta_title" value="<?php echo htmlspecialchars($page[0]['page_meta_title'] ?? ''); ?>">
                <small class="form-text text-muted">Optimal length: 50-60 characters</small>
            </div>
        </div>

        <div class="form-group row">
            <label for="meta_desc" class="col-sm-2 col-form-label">Meta Description</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="meta_desc" name="meta_desc" rows="3" placeholder="Page description (150-160 characters)"><?php echo htmlspecialchars($page[0]['page_meta_desc'] ?? ''); ?></textarea>
                <small class="form-text text-muted">Optimal length: 150-160 characters</small>
            </div>
        </div>

        <div class="form-group row">
            <label for="meta_keywords" class="col-sm-2 col-form-label">Meta Keywords</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="meta_keywords" placeholder="Comma separated keywords" name="meta_keywords" value="<?php echo htmlspecialchars($page[0]['page_meta_keywords'] ?? ''); ?>">
                <small class="form-text text-muted">Example: keyword1, keyword2, keyword3</small>
            </div>
        </div>

        <div class="form-group row">
            <label for="focus_keyword" class="col-sm-2 col-form-label">Focus Keyword</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="focus_keyword" placeholder="Primary keyword for this page" name="focus_keyword" value="<?php echo htmlspecialchars($page[0]['focus_keyword'] ?? ''); ?>">
                <small class="form-text text-muted">Used for SEO analysis and optimization</small>
            </div>
        </div>
    </div>
</div>

<!-- Advanced SEO Card -->
<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Advanced SEO Settings</h5>
    </div>
    <div class="card-body">
        <div class="form-group row">
            <label for="canonical_url" class="col-sm-2 col-form-label">Canonical URL</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="canonical_url" placeholder="https://example.com/page" name="canonical_url" value="<?php echo htmlspecialchars($page[0]['page_canonical_url'] ?? ''); ?>">
                <small class="form-text text-muted">Leave blank to use default URL</small>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Robots Directives</label>
            <div class="col-sm-10">
                <div class="row">
                    <div class="col-md-3">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="meta_index" name="meta_index" <?php echo ($page[0]['page_meta_index'] ?? 1) ? 'checked' : ''; ?>>
                            <label class="custom-control-label" for="meta_index">Index</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="meta_follow" name="meta_follow" <?php echo ($page[0]['page_meta_follow'] ?? 1) ? 'checked' : ''; ?>>
                            <label class="custom-control-label" for="meta_follow">Follow</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="meta_archive" name="meta_archive" <?php echo ($page[0]['page_meta_archive'] ?? 1) ? 'checked' : ''; ?>>
                            <label class="custom-control-label" for="meta_archive">Archive</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="meta_imageindex" name="meta_imageindex" <?php echo ($page[0]['page_meta_imageindex'] ?? 1) ? 'checked' : ''; ?>>
                            <label class="custom-control-label" for="meta_imageindex">Image Index</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Sitemap Settings Card -->
<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Sitemap Settings</h5>
    </div>
    <div class="card-body">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Sitemap Settings</label>
            <div class="col-sm-10">
                <div class="row">
                    <div class="col-md-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="include_in_sitemap" name="include_in_sitemap" <?php echo ($page[0]['include_in_sitemap'] ?? 1) ? 'checked' : ''; ?>>
                            <label class="custom-control-label" for="include_in_sitemap">Include in Sitemap</label>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <select class="custom-select" name="sitemap_priority" id="sitemap_priority">
                            <option value="1.0" <?php echo (isset($page[0]['sitemap_priority']) && $page[0]['sitemap_priority'] == '1.0') ? 'selected' : ''; ?>>1.0 - Highest Priority</option>
                            <option value="0.9" <?php echo (isset($page[0]['sitemap_priority']) && $page[0]['sitemap_priority'] == '0.9') ? 'selected' : ''; ?>>0.9</option>
                            <option value="0.8" <?php echo (!isset($page[0]['sitemap_priority']) || $page[0]['sitemap_priority'] == '0.8') ? 'selected' : ''; ?>>0.8 - Default</option>
                            <option value="0.7" <?php echo (isset($page[0]['sitemap_priority']) && $page[0]['sitemap_priority'] == '0.7') ? 'selected' : ''; ?>>0.7</option>
                            <option value="0.6" <?php echo (isset($page[0]['sitemap_priority']) && $page[0]['sitemap_priority'] == '0.6') ? 'selected' : ''; ?>>0.6</option>
                            <option value="0.5" <?php echo (isset($page[0]['sitemap_priority']) && $page[0]['sitemap_priority'] == '0.5') ? 'selected' : ''; ?>>0.5 - Low Priority</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <select class="custom-select" name="sitemap_changefreq" id="sitemap_changefreq">
                            <option value="always" <?php echo (isset($page[0]['sitemap_changefreq']) && $page[0]['sitemap_changefreq'] == 'always') ? 'selected' : ''; ?>>Always</option>
                            <option value="hourly" <?php echo (isset($page[0]['sitemap_changefreq']) && $page[0]['sitemap_changefreq'] == 'hourly') ? 'selected' : ''; ?>>Hourly</option>
                            <option value="daily" <?php echo (isset($page[0]['sitemap_changefreq']) && $page[0]['sitemap_changefreq'] == 'daily') ? 'selected' : ''; ?>>Daily</option>
                            <option value="weekly" <?php echo (!isset($page[0]['sitemap_changefreq']) || $page[0]['sitemap_changefreq'] == 'weekly') ? 'selected' : ''; ?>>Weekly</option>
                            <option value="monthly" <?php echo (isset($page[0]['sitemap_changefreq']) && $page[0]['sitemap_changefreq'] == 'monthly') ? 'selected' : ''; ?>>Monthly</option>
                            <option value="yearly" <?php echo (isset($page[0]['sitemap_changefreq']) && $page[0]['sitemap_changefreq'] == 'yearly') ? 'selected' : ''; ?>>Yearly</option>
                            <option value="never" <?php echo (isset($page[0]['sitemap_changefreq']) && $page[0]['sitemap_changefreq'] == 'never') ? 'selected' : ''; ?>>Never</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Social & Schema Card -->
<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Social & Schema</h5>
    </div>
    <div class="card-body">
        <div class="form-group row">
            <label for="social_image" class="col-sm-2 col-form-label">Social Share Image</label>
            <div class="col-sm-10">
                <div class="input-group">
                    <input type="text" class="form-control" id="social_image" placeholder="URL for social sharing (1200x630px)" name="social_image" value="<?php echo htmlspecialchars($page[0]['social_image'] ?? ''); ?>">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" onclick="OpenMediaGallery('social_image')" type="button">
                            <i class="fa fa-picture-o"></i> Gallery
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="schema_markup" class="col-sm-2 col-form-label">Custom Schema</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="schema_markup" name="schema_markup" rows="4" placeholder="Custom JSON-LD schema markup"><?php echo htmlspecialchars($page[0]['schema_markup'] ?? ''); ?></textarea>
                <small class="form-text text-muted">Add custom schema.org JSON-LD markup for this page</small>
            </div>
        </div>
    </div>
</div>