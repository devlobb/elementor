<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Control_Box_Shadow extends Control_Base_Multiple {

	public function get_type() {
		return 'box_shadow';
	}

	public function get_default_value() {
		return [
			'horizontal' => 0,
			'vertical' => 0,
			'blur' => 0,
			'spread' => 0,
			'inset' => '',
			'shadow' => '',
		];
	}

	public function get_sliders() {
		return [
			[ 'label' => __( 'Horizontal', 'elementor' ), 'type' => 'horizontal' ],
			[ 'label' => __( 'Vertical', 'elementor' ), 'type' => 'vertical' ],
			[ 'label' => __( 'Blur', 'elementor' ), 'type' => 'blur' ],
			[ 'label' => __( 'Spread', 'elementor' ), 'type' => 'spread' ],
		];
	}

	public function get_colors() {
		return [
			[ 'label' => __( 'Color', 'elementor' ), 'type' => 'shadow' ],
		];
	}

	public function content_template() {
		?>
		<?php
		foreach ( $this->get_sliders() as $slider ) : ?>
			<div class="elementor-control-wrapper">
				<label class="elementor-control-label">
					<?php echo $slider['label']; ?>
				</label>
				<div class="elementor-control-input-wrapper">
					<div class="elementor-control-slider" data-input="<?php echo $slider['type']; ?>"></div>
					<div class="elementor-control-slider-input">
						<input type="number" min="<%- data.min %>" max="<%- data.max %>" step="<%- data.step %>"
						       data-setting="<?php echo $slider['type']; ?>"/>
					</div>
				</div>
			</div>
		<?php endforeach; ?>

		<?php
		foreach ( $this->get_colors() as $color ) : ?>
			<%
			var defaultValue = '', dataAlpha = '';
			if ( data.default ) {
				if ( '#' !== data.default.substring( 0, 1 ) ) {
					defaultValue = '#' + data.default;
				} else {
					defaultValue = data.default;
				}
				defaultValue = ' data-default-color=' + defaultValue; // Quotes added automatically.
			}

			dataAlpha = ' data-alpha="true"';
			%>
			<div class="elementor-control-field">
				<label class="elementor-control-title">
					<?php echo $color['label']; ?>
				</label>
				<div class="elementor-control-input-wrapper">
					<input data-setting="<?php echo $color['type']; ?>" class="elementor-box-shadow-color-picker" type="text" maxlength="7"
					       placeholder="<?php esc_attr_e( 'Hex Value', 'elementor' ); ?>" <%= defaultValue %><%=
					dataAlpha %> />
				</div>
			</div>
			<?php
		endforeach;
	}
}
