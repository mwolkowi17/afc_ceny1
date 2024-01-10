<?php get_header(); ?>
<div style="height: 300px; background-color: #291C0E;"></div>
<?php //if ( is_user_logged_in() ): ?> 
<?php if( current_user_can( 'administrator' ) ): ?>
<?php if (have_posts()) : ?>
    <div class="container mx-auto">
    <table class="table">
    <thead>
        <tr>
            
            <th scope="col">Produkt</th>
            <th scope="col">Cena netto Agrosik</th>
            <th scope="col">Cena + transport</th>
            <th scope="col">Cena + 30%</th>
            <th scope="col"><Details></Details></th>
        
        </tr>
    </thead>
    <tbody>
        <?php while (have_posts()) : the_post(); ?>
            <?php $cenaAgrosik = get_field('cena_netto_agrosik');
                  $cenaAgrosikItransport=$cenaAgrosik+2.3;
                  $cenaZmarzaZl= $cenaAgrosikItransport+$cenaAgrosikItransport*0.3;
                  $cenaZmarzaEuro = $cenaZmarzaZl/4.3;
                  $cenaZmarzaEuroZaokraglona =round($cenaZmarzaEuro,2);
            ?>
            <tr>
           
            <td><?php the_title() ?></td>
            <td><?php the_field('cena_netto_agrosik') ?> zł</td>
            <td><?php echo $cenaAgrosikItransport ?> zł</td>
            <td><?php echo $cenaZmarzaEuroZaokraglona?> euro</td>
            <!-- <td> <a href="<?php the_permalink(); ?>"> Zobacz</a></td> -->
           
        </tr>
        <?php endwhile; ?>
        </tbody>
        </table>
    </div>
<?php endif; ?>
<?php endif; ?>
<?php get_footer(); ?>
<?php //the_field('cena_+_transport_zl') ?> 