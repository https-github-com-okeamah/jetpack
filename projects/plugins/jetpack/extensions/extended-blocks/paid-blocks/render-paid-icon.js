import { isUpgradable } from '@automattic/jetpack-shared-extension-utils';
import PaidSymbol from './paid-symbol';

/**
 * Enhance the default block icon with a paid indicator
 *
 * @param {object} icon - The block default icon.
 * @return {object} The default icon enhanced with the PaidSymbol
 */
const renderPaidIcon = icon => {
	const paidSymbol = <PaidSymbol key="paid-symbol" />;

	if ( icon?.src ) {
		return {
			...icon,
			src: (
				<>
					{ icon.src }
					{ paidSymbol }
				</>
			),
		};
	}

	return (
		<>
			{ icon }
			{ paidSymbol }
		</>
	);
};

export default renderPaidIcon;

/**
 * Helper function to extend the given icon.
 * checking before if the block is upgradable.
 *
 * @param {string} name - Block name to check if it's upgradable.
 * @param {object} icon - Icon to extend, or not.
 * @return {object} Block Icon.
 */
export function extendWithPaidIcon( name, icon ) {
	if ( ! isUpgradable( name ) ) {
		return icon;
	}

	return renderPaidIcon( icon );
}
