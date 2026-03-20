<?php

namespace App\Enums;

enum Category: string
{
    case CybersecurityGovernance = 'Cybersecurity Governance';
    case PoliciesAndProcedureManagement = 'Policies and Procedure Management';
    case RiskManagement = 'Risk Management';
    case HumanResource = 'Human Resource';
    case CybersecurityTrainingAndAwareness = 'Cybersecurity Training & Awareness';
    case AssetManagement = 'Asset Management';
    case IdentityAndAccessManagement = 'Identity and Access Management';
    case NetworkSecurity = 'Network Security';
    case Cryptography = 'Cryptography';
    case BackupAndRecoveryManagement = 'Backup & Recovery Management';
    case VulnerabilityAndPenetrationTesting = 'Vulnerability & Penetration Testing';
    case IncidentHandling = 'Incident Handling';
    case PhysicalSecurity = 'Physical Security';
    case ApplicationDevelopment = 'Application Development';
    case BusinessContinuityAndCrisesManagement = 'Business Continuity and Crises Management';
    case SupplyChain = 'Supply Chain';
    case Other = 'Others';

    /** @return array<string, string> */
    public static function options(): array
    {
        return array_column(self::cases(), 'value', 'value');
    }
}
