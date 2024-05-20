<?php
$is_granted = Arrowpress_Developer_Access::is_granted();
?>

<div class="tc-developer-access">
    <div class="tc-notice tc-success">
        <div class="content">
            <h3><?php esc_html_e( 'Developer access', 'arrowpress-core' ); ?></h3>

            <form method="post">
                <?php
                wp_nonce_field( 'arrowpress_core_developer_access', 'arrowpress_core_developer_access' );
                ?>
                <?php
                if ( $is_granted ) :
                    $link_access = Arrowpress_Developer_Access::get_link_access();
                    ?>
                    <input type="hidden" name="tc-revoke-developer-access" value="1" title="revoke">
                    <button class="button button-secondary"
                            type="submit"><?php esc_html_e( 'Revoke developer access', 'arrowpress-core' ); ?></button>
                    <button class="button button-primary tc-btn-copy-link" type="button"
                            data-clipboard-target="#tc-link-developer-access"><?php esc_html_e( 'Copy link', 'arrowpress-core' ); ?></button>

                    <div class="link">
                        <textarea id="tc-link-developer-access" class="widefat" title="link" rows="1"
                                  readonly><?php echo esc_url( $link_access ); ?></textarea>
                    </div>
                <?php else : ?>
                    <input type="hidden" name="tc-grant-developer-access" value="1" title="grant">
                    <button class="button button-primary"
                            type="submit"><?php esc_html_e( 'Allow developer access', 'arrowpress-core' ); ?></button>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>
