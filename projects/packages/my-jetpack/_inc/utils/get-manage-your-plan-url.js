// eslint-disable-next-line no-unused-vars
/* global myJetpackInitialState */

import { getRedirectUrl } from '@automattic/jetpack-components';
import { MY_JETPACK_MY_PLANS_MANAGE_SOURCE } from '../constants';
import getMyJetpackWindowState from '../data/utils/get-my-jetpack-window-state';

/**
 * Return the redurect URL, according to the Jetpack redurects source.
 *
 * @returns {string}            the redirect URL
 */
export default function () {
	const { siteSuffix: site = '', blogID } = getMyJetpackWindowState();

	return getRedirectUrl( MY_JETPACK_MY_PLANS_MANAGE_SOURCE, { site: blogID ?? site } );
}
