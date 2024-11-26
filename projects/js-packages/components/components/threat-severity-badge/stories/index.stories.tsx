import React from 'react';
import ThreatSeverityBadge from '../index.js';

export default {
	title: 'JS Packages/Components/Threat Severity Badge',
	component: ThreatSeverityBadge,
};

export const Low = args => <ThreatSeverityBadge { ...args } />;
Low.args = { severity: 1 };
export const High = args => <ThreatSeverityBadge { ...args } />;
High.args = { severity: 3 };
export const Critical = args => <ThreatSeverityBadge { ...args } />;
Critical.args = { severity: 5 };
