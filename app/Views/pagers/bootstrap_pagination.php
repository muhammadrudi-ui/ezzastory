<style>
    /* Custom CSS for dark pagination */
    .pagination .page-item .page-link {
        color: #343a40;
        border-color: #dee2e6;
        transition: all 0.2s ease;
    }

    .pagination .page-item.active .page-link {
        background-color: #343a40;
        border-color: #343a40;
        color: white;
    }

    .pagination .page-item .page-link:hover:not(.disabled) {
        background-color: #e9ecef;
        border-color: #dee2e6;
    }

    /* Responsive adjustments */
    @media (max-width: 576px) {
        .pagination .page-text {
            display: none;
        }

        .pagination .page-link {
            padding: 0.375rem 0.5rem;
        }
    }
</style>

<?php $pager->setSurroundCount(5) ?>

<nav aria-label="Page navigation">
    <ul class="pagination pagination-md justify-content-center flex-wrap gap-1">
        <!-- Previous Page Link -->
        <?php if ($pager->hasPrevious()): ?>
            <li class="page-item">
                <a class="page-link d-flex align-items-center" href="<?= $pager->getPrevious() ?>" tabindex="-1">
                    <i class="bi bi-chevron-left me-1"></i>
                    <span class="page-text">Previous</span>
                </a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <a class="page-link d-flex align-items-center" href="#" tabindex="-1" aria-disabled="true">
                    <i class="bi bi-chevron-left me-1"></i>
                    <span class="page-text">Previous</span>
                </a>
            </li>
        <?php endif ?>

        <!-- Page Number Links -->
        <?php foreach ($pager->links() as $link): ?>
            <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
                <a class="page-link" href="<?= $link['uri'] ?>"><?= $link['title'] ?></a>
            </li>
        <?php endforeach ?>

        <!-- Next Page Link -->
        <?php if ($pager->hasNext()): ?>
            <li class="page-item">
                <a class="page-link d-flex align-items-center" href="<?= $pager->getNext() ?>">
                    <span class="page-text">Next</span>
                    <i class="bi bi-chevron-right ms-1"></i>
                </a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <a class="page-link d-flex align-items-center" href="#" aria-disabled="true">
                    <span class="page-text">Next</span>
                    <i class="bi bi-chevron-right ms-1"></i>
                </a>
            </li>
        <?php endif ?>
    </ul>
</nav>