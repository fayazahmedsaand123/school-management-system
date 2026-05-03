import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link } from '@inertiajs/react';

export default function Dashboard({ stats }) {
    const cards = [
        {
            label: 'Schools',
            value: stats?.schools ?? 0,
            icon: '🏫',
            color: '#3b82f6',
            href: '/tenants',
        },
        {
            label: 'Teachers',
            value: stats?.teachers ?? 0,
            icon: '👨‍🏫',
            color: '#10b981',
            href: '/teachers',
        },
        {
            label: 'Students',
            value: stats?.students ?? 0,
            icon: '🧑‍🎓',
            color: '#f59e0b',
            href: '/students',
        },
        {
            label: 'Courses',
            value: stats?.courses ?? 0,
            icon: '📚',
            color: '#8b5cf6',
            href: '/courses',
        },
        {
            label: 'Enrollments',
            value: stats?.enrollments ?? 0,
            icon: '📝',
            color: '#ef4444',
            href: '/enrollments',
        },
    ];

    return (
        <AuthenticatedLayout header="📊 Dashboard">
            <Head title="Dashboard" />

            {/* Welcome Message */}
            <div style={{
                background: '#fff',
                borderRadius: '10px',
                padding: '20px 24px',
                marginBottom: '24px',
                boxShadow: '0 1px 4px rgba(0,0,0,0.08)',
            }}>
                <h2 style={{ margin: 0, fontSize: '18px', color: '#1e293b' }}>
                    Welcome to School Management System! 👋
                </h2>
                <p style={{ margin: '6px 0 0', color: '#64748b', fontSize: '14px' }}>
                    Here is your tenant overview for today.
                </p>
            </div>

            {/* Stat Cards */}
            <div style={{
                display: 'grid',
                gridTemplateColumns: 'repeat(auto-fit, minmax(180px, 1fr))',
                gap: '16px',
                marginBottom: '24px',
            }}>
                {cards.map((card) => (
                    <Link
                        key={card.label}
                        href={card.href}
                        style={{ textDecoration: 'none' }}
                    >
                        <div style={{
                            background: '#fff',
                            borderRadius: '12px',
                            padding: '20px',
                            boxShadow: '0 1px 4px rgba(0,0,0,0.08)',
                            borderTop: `4px solid ${card.color}`,
                            transition: 'transform 0.2s',
                            cursor: 'pointer',
                        }}
                            onMouseEnter={e => e.currentTarget.style.transform = 'translateY(-3px)'}
                            onMouseLeave={e => e.currentTarget.style.transform = 'translateY(0)'}
                        >
                            <div style={{ fontSize: '32px', marginBottom: '8px' }}>{card.icon}</div>
                            <div style={{ fontSize: '28px', fontWeight: 'bold', color: card.color }}>
                                {card.value}
                            </div>
                            <div style={{ fontSize: '14px', color: '#64748b', marginTop: '4px' }}>
                                {card.label}
                            </div>
                        </div>
                    </Link>
                ))}
            </div>

            {/* Quick Links */}
            <div style={{
                background: '#fff',
                borderRadius: '10px',
                padding: '20px 24px',
                boxShadow: '0 1px 4px rgba(0,0,0,0.08)',
            }}>
                <h3 style={{ margin: '0 0 16px', fontSize: '16px', color: '#1e293b' }}>
                    ⚡ Quick Actions
                </h3>
                <div style={{ display: 'flex', gap: '12px', flexWrap: 'wrap' }}>
                    {[
                        { label: '+ Add School',      href: '/tenants/create',     color: '#3b82f6' },
                        { label: '+ Add Teacher',     href: '/teachers/create',    color: '#10b981' },
                        { label: '+ Add Student',     href: '/students/create',    color: '#f59e0b' },
                        { label: '+ Add Course',      href: '/courses/create',     color: '#8b5cf6' },
                        { label: '+ Enroll Student',  href: '/enrollments/create', color: '#ef4444' },
                    ].map(btn => (
                        <Link
                            key={btn.label}
                            href={btn.href}
                            style={{
                                background: btn.color,
                                color: '#fff',
                                padding: '10px 18px',
                                borderRadius: '8px',
                                textDecoration: 'none',
                                fontSize: '13px',
                                fontWeight: '500',
                            }}
                        >
                            {btn.label}
                        </Link>
                    ))}
                </div>
            </div>

        </AuthenticatedLayout>
    );
}