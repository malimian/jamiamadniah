  // Loading spinner control
        function loader(show = true) {
            const spinner = document.getElementById('spinner-loader');
            if (!spinner) return;
            
            if (show) {
                spinner.classList.remove('d-none');
                // Ensure spinner is visible and on top
                spinner.style.display = 'flex';
                spinner.style.zIndex = '9999';
            } else {
                spinner.classList.add('d-none');
                spinner.style.display = 'none';
            }
        }
        
        // Enhanced PAGE_LOADER function
        function PAGE_LOADER() {
            try {
                loader(true); // Show loader
                
                if (typeof templateData === 'undefined') {
                    console.error('Template data not available');
                    loader(false);
                    return;
                }

                const container = document.getElementById('template-content-container');
                if (!container) {
                    console.error('Template container not found');
                    loader(false);
                    return;
                }

                // Show loading progress
                console.log('Loading template content...');
                
                // Parse and sanitize content
                const parser = new DOMParser();
                const doc = parser.parseFromString(templateData.content, 'text/html');
                const sanitizedContent = doc.body.innerHTML;

                // Simulate loading delay for demo (remove in production)
                setTimeout(() => {
                    // Insert content
                    container.innerHTML = sanitizedContent;
                    container.style.display = 'block';

                    // Update page title if available
                    if (templateData.page_title) {
                        document.title = templateData.page_title;
                    }

                    console.log(`Content loaded successfully for page ID: ${templateData.page_id}`);
                    loader(false); // Hide loader
                    
                    // Dispatch custom event
                    document.dispatchEvent(new CustomEvent('templateLoaded', {
                        detail: {
                            pageId: templateData.page_id,
                            container: container
                        }
                    }));
                }, 300); // Small delay for smooth transition (adjust as needed)
                
            } catch (error) {
                console.error('PAGE_LOADER error:', error);
                loader(false);
                // Fallback to direct rendering
                if (typeof templateData !== 'undefined' && templateData.content) {
                    document.body.insertAdjacentHTML('beforeend', templateData.content);
                }
            }

            initDynamicComponents();
        }

        // Initialize loader with multiple fallbacks
        function initLoader() {
            loader(true); // Show loader immediately
            
            if (document.readyState === 'complete' || document.readyState === 'interactive') {
                PAGE_LOADER();
            } else {
                document.addEventListener('DOMContentLoaded', PAGE_LOADER);
                // Fallback in case DOMContentLoaded doesn't fire
                setTimeout(() => {
                    if (document.getElementById('template-content-container').innerHTML === '') {
                        PAGE_LOADER();
                    }
                }, 5000);
            }
        }
        
        // Start the loader
        initLoader();


function initDynamicComponents() {
    // Event delegation for load more button
    document.addEventListener('click', function(e) {
        if (e.target && e.target.id === 'load-more-btn') {
            handleLoadMore(e.target);
        }
    });
}



function handleLoadMore(loadMoreBtn) {
    const analysisContainer = document.getElementById('analysis-container');
    const loadingSpinner = document.getElementById('loading-spinner');
    
    if (!analysisContainer || !loadingSpinner) {
        console.error('Required elements not found');
        return;
    }
    
    const offset = parseInt(loadMoreBtn.getAttribute('data-offset'));
    const catid = loadMoreBtn.getAttribute('data-catid');
    
    // Show loading spinner
    loadMoreBtn.classList.add('d-none');
    loadingSpinner.classList.remove('d-none');
    
    fetch(`post/load_more_analysis.php?offset=${offset}&catid=${catid}`)
        .then(response => response.text())
        .then(data => {
            if (data.trim() !== '') {
                analysisContainer.insertAdjacentHTML('beforeend', data);
                loadMoreBtn.setAttribute('data-offset', offset + 5);
                loadMoreBtn.classList.remove('d-none');
            } else {
                loadMoreBtn.textContent = 'No more analysis to load';
                loadMoreBtn.classList.add('disabled');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            loadMoreBtn.textContent = 'Error loading content';
        })
        .finally(() => {
            loadingSpinner.classList.add('d-none');
        });
}