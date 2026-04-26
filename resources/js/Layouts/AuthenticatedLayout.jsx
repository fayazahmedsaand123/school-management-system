import { useState } from 'react';
import { Link, usePage } from '@inertiajs/react';

export default function AuthenticatedLayout({ header, children }) {
    const { auth, tenants, currentTenant, flash } = usePage().props;
    const [sidebarOpen, setSidebarOpen] = useState(true);
    const [dropdownOpen, setDropdownOpen] = useState(false);

    const menuItems = [
        { label: 'Dashboard',   href: '/dashboard',   icon: '📊' },
        { label: 'Schools',     href: '/tenants',      icon: '🏫' },
        { label: 'Teachers',    href: '/teachers',     icon: '👨‍🏫' },
        { label: 'Students',    href: '/students',     icon: '🧑‍🎓' },
        { label: 'Courses',     href: '/courses',      icon: '📚' },
        { label: 'Enrollments', href: '/enrollments',  icon: '📝' },
    ];

    return (
        <div style={{ display: 'flex', minHeight: '100vh', fontFamily: 'sans-serif' }}>

            {/* Sidebar */}
            <div style={{
                width: sidebarOpen ? '220px' : '60px',
                background: '#1e293b',
                color: '#fff',
                transition: 'width 0.3s',
                overflow: 'hidden',
                flexShrink: 0,
            }}>
                {/* Logo */}
                <div style={{
                    padding: '20px 16px',
                    fontSize: '18px',
                    fontWeight: 'bold',
                    borderBottom: '1px solid #334155'
                }}>
                    {sidebarOpen ? '🏫 SchoolMS' : '🏫'}
                </div>

                {/* Current Tenant Badge */}
                {sidebarOpen && currentTenant && (
                    <div style={{
                        padding: '10px 16px',
                        background: '#0f172a',
                        fontSize: '12px',
                        color: '#94a3b8',
                        borderBottom: '1px solid #334155',
                    }}>
                        📍 {currentTenant.name}
                    </div>
                )}

                {/* Menu Items */}
                <nav style={{ marginTop: '10px' }}>
                    {menuItems.map((item) => (
                        <Link
                            key={item.href}
                            href={item.href}
                            style={{
                                display: 'flex',
                                alignItems: 'center',
                                gap: '12px',
                                padding: '12px 16px',
                                color: '#cbd5e1',
                                textDecoration: 'none',
                                fontSize: '14px',
                                transition: 'background 0.2s',
                            }}
                            onMouseEnter={e => e.currentTarget.style.background = '#334155'}
                            onMouseLeave={e => e.currentTarget.style.background = 'transparent'}
                        >
                            <span style={{ fontSize: '18px' }}>{item.icon}</span>
                            {sidebarOpen && <span>{item.label}</span>}
                        </Link>
                    ))}
                </nav>

                {/* Switch School */}
                {sidebarOpen && tenants && tenants.length > 1 && (
                    <div style={{
                        position: 'absolute',
                        bottom: '20px',
                        width: '220px',
                        padding: '0 16px',
                    }}>
                        <div style={{ fontSize: '12px', color: '#64748b', marginBottom: '6px' }}>
                            Switch School:
                        </div>
                        {tenants.map(tenant => (
                            <Link
                                key={tenant.id}
                                href={`/switch-tenant/${tenant.id}`}
                                style={{
                                    display: 'block',
                                    padding: '8px 10px',
                                    marginBottom: '4px',
                                    borderRadius: '6px',
                                    fontSize: '12px',
                                    textDecoration: 'none',
                                    background: currentTenant?.id === tenant.id ? '#3b82f6' : '#334155',
                                    color: '#fff',
                                }}
                            >
                                🏫 {tenant.name}
                            </Link>
                        ))}
                    </div>
                )}
            </div>

            {/* Main Content */}
            <div style={{ flex: 1, display: 'flex', flexDirection: 'column' }}>

                {/* Top Navbar */}
                <div style={{
                    background: '#fff',
                    padding: '14px 24px',
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'space-between',
                    borderBottom: '1px solid #e2e8f0',
                    boxShadow: '0 1px 4px rgba(0,0,0,0.05)',
                }}>
                    {/* Toggle Button */}
                    <button
                        onClick={() => setSidebarOpen(!sidebarOpen)}
                        style={{
                            background: 'none',
                            border: 'none',
                            fontSize: '22px',
                            cursor: 'pointer',
                        }}
                    >
                        ☰
                    </button>

                    {/* User Info */}
                    <div style={{ display: 'flex', alignItems: 'center', gap: '12px' }}>
                        <span style={{ fontSize: '14px', color: '#475569' }}>
                            👤 {auth.user.name}
                        </span>
                        <Link
                            href={route('logout')}
                            method="post"
                            as="button"
                            style={{
                                background: '#ef4444',
                                color: '#fff',
                                border: 'none',
                                padding: '6px 14px',
                                borderRadius: '6px',
                                cursor: 'pointer',
                                fontSize: '13px',
                            }}
                        >
                            Logout
                        </Link>
                    </div>
                </div>

                {/* Flash Message */}
                {flash?.success && (
                    <div style={{
                        background: '#dcfce7',
                        color: '#166534',
                        padding: '12px 24px',
                        fontSize: '14px',
                    }}>
                        ✅ {flash.success}
                    </div>
                )}

                {/* Page Header */}
                {header && (
                    <div style={{
                        padding: '20px 24px 0',
                        fontSize: '20px',
                        fontWeight: 'bold',
                        color: '#1e293b'
                    }}>
                        {header}
                    </div>
                )}

                {/* Page Content */}
                <main style={{ padding: '24px', flex: 1, background: '#f8fafc' }}>
                    {children}
                </main>

            </div>
        </div>
    );
}